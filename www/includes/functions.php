<?php
	class Utils 
	{
		public static function checkLogin() {
			if(!isset($_SESSION['admin_id'])) {
				Utils::redirect("admin_login.php", "");
			}
		}

		public static function displayError($key, $arr) {

			if(isset($arr[$key])) {
				echo '<span class="err">'.$arr[$key]. '</span>';
			}

		}


		public static function doRegistration($dbconn, $input) {
			$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");

			$data = [
				":fn" => $input['fname'],
				":ln" => $input['lname'],
				":e" => $input['email'],
				":h" => $input['password']
			];

			$stmt->execute($data);
		} 


		public static function doesEmailExist($dbconn, $email) {
			$result = false;

			$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");
			$stmt->bindParam(":e", $email); 

			$stmt->execute();

			# count result set
			$count = $stmt->rowCount();

			if($count > 0) { $result = true; }

			return $result;
		}


		public static function doLogin($dbconn, $input) {
			$result = [];

			$stmt = $dbconn->prepare("SELECT admin_id, hash FROM admin WHERE email=:e");
			$stmt->bindParam(":e", $input['email']);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_BOTH);

			# if either the email or password is wrong, we return a false array
			if( ($stmt->rowCount() != 1) || !password_verify($input['password'], $row['hash']) ) {

			Utils::redirect("admin_login.php?+msg=", "either username or password is incorrect");
				exit();
			} else {
				# return true plus extra information...
				$result[] = true;
				$result[] = $row['admin_id'];
			}

			return $result;
		}


		public static function redirect($loc, $msg) {
			header("Location: ".$loc.$msg);
		}

		public static function addPost($dbconn, $input) {
			$stmt = $dbconn->prepare("INSERT INTO post(title, content, admin_id, post_date) VALUES(:t, :c, :a, NOW())");

			$data = [
					":t" => $input['title'],
					":c" => $input['content'],
					":a" => $input['aid'],
					];

		//	print_r($data);

			$stmt->execute($data);

		}

		public static function curNav($page) {
			$curPage = basename($_SERVER['SCRIPT_FILENAME']);
			if($curPage == $page) {
				echo 'class="selected"';
			}
		}

		public static function doLogout($leave){
			unset($leave['admin_id']);
	
			Utils::redirect("admin_login.php", "");

		}


		public static function fetchPost($dbconn) {
			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM post");
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {

				$result .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[4].'</td>
				<td><a href="edit_post.php?post_id='.$row[0].'">edit</a></td>
				<td><a href="delete.php?post_id='.$row[0].'">delete</a></td></tr>';
			}

			return $result;
		}

		public static function updatePost($dbconn, $input) {
			$stmt = $dbconn->prepare("UPDATE post SET title=:t, content=:c WHERE post_id=:pid");

			$data = [
				":t" => $input['title'],
				":c" => $input['content'],
				":pid" => $input['pid'],
			];

			$stmt->execute($data);
		}

		public static function getPostByID($dbconn, $post_id) {
			$stmt = $dbconn->prepare("SELECT * FROM post WHERE post_id=:pid");
			$stmt->bindParam(":pid", $post_id);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_BOTH);

			return $row;
		}

		public static function deletePost($dbconn, $pid){

		$stmt = $dbconn->prepare("DELETE FROM post WHERE post_id =:pid");

		$stmt->bindParam(":pid", $pid);

		$stmt->execute();

		Utils::redirect("view_post.php?+msg=", "Deleted");

		}

		public static function displayPost($dbconn) {
			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM post");

			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {

				$result .= '<h2 class="blog-post-title">'.$row[1].'</h2><p class="blog-post-meta">'.$row[4].'<a href="#">'.$row[3].'</a></p><p>'.$row[2].'</p>';
			}

			return $result;
		}

/*		public static function showAdmins($dbconn) {
			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM admin");
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
				$result .= '<a href="profile.php?aid='.$row[0].'">'.$row[1].'</a><br/>';
			}

			return $result;
		}

		public static function extraInfo($dbconn, $admin_id) {
			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM admin WHERE admin_id=:aid");
			$stmt->bindParam(":aid", $admin_id);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
				$result .= '<p>'.$row['email'].'</p><h3>'.$row['lastname'].'</h3><br/>';
			}

			return $result;
		}




		
		*/

	}

