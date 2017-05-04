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

		Utils::deletePost($conn, $_GET['post_id']);

	}

?>
