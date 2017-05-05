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

	if(isset($_GET['post_id'])) {

		$pID = $_GET['post_id'];

	}

	$post = Utils::getPostByID($conn, $pID);


	Utils::archivePost($conn, $post);

	Utils::redirect("view_post.php?msg=", "Archived Successfully");


?>