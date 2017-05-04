<?php
	session_start();

	# import functions lib..
	include 'includes/functions.php';

	# include dashboard header
	include 'includes/dashboard_header.php';

	# include db connection
	include 'includes/connection.php';

	$id = $_SESSION['admin_id'];

	# determine if user is logged in.
	Utils::checkLogin();

	# track errors
	$errors = [];

	if(array_key_exists('add', $_POST)) {
	//	var_dump($_POST); exit();

		if(empty($_POST['title'])) {
			$errors['title'] = "Please enter a Title";
		}

		if(empty($_POST['content'])) {
			$errors['content'] = "Please enter the Content";
		}

		if(empty($errors)) {
			$clean = array_map('trim', $_POST);
			
			$clean['aid'] = $id;

			Utils::addPost($conn, $clean);

			Utils::redirect("add_post.php?+msg=", "Successfully Posted");

		}

	}
?>

<div class="wrapper">
	<div id="stream">
		
		<h1 id="register-label">Add Post</h1>
		<hr>
		<form id="register" action ="add_post.php" method ="POST">

			<div>
				<?php Utils::displayError('title', $errors); ?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title">
			</div>


			<div>
				<?php Utils::displayError('content', $errors); ?>
				<label>Content:</label>
				<textarea name="content" cols="5" rows="5"></textarea>
			</div>


			<input type="submit" name="add" value="Post">

		</form>


	</div>
</div>


<?php
	
	include 'includes/footer.php';

?>