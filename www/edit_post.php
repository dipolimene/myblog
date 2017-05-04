<?php
	session_start();

	# import functions lib..
	include 'includes/functions.php';

	# include dashboard header
	include 'includes/dashboard_header.php';

	# include db connection
	include 'includes/connection.php';

	# determine if user is logged in.
	Utils::checkLogin();

	if(isset($_GET['post_id'])) {
		$pID = $_GET['post_id'];
	}

	# use DAO to fetch the current object's
	# data..
	$item = Utils::getPostByID($conn, $pID);

	$errors = [];

	if(array_key_exists('edit', $_POST)) {

		if(empty($_POST['title'])) {
			$errors['title'] = "Please enter a new Title";
		}

		if(empty($_POST['content'])) {
			$errors['content'] = "Please enter a new Content";
		}

		if(empty($errors)) {
			$clean = array_map('trim', $_POST);
			$clean['pid'] = $pID;

			# do update..
			Utils::updatePost($conn, $clean);

			# redirect..
			Utils::redirect("view_post.php", "");
		}
	}
	
?>

<div class="wrapper">
	<div id="stream">
		
		<h1 id="register-label">Edit Post</h1>
		<hr>
		<form id="register"  action ="<?php echo 'edit_post.php?post_id='.$pID; ?>" method ="POST">

			<div>
				<?php Utils::displayError('title', $errors); ?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title" value="<?php echo $item[1]; ?>">
			</div>


			<div>
				<?php Utils::displayError('content', $errors); ?>
				<label>Content:</label>
				<textarea name="content" cols="5" rows="5"> <?php echo $item[2]; ?> </textarea>
			</div>

			<input type="submit" name="edit" value="Edit">
		</form>


	</div>
</div>


<?php
	
	include 'includes/footer.php';

?>