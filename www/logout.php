<?php
	
	session_start();

	# import functions lib..
	include 'includes/functions.php';

	# include dashboard header
	include 'includes/dashboard_header.php';

	# include db connection
	include 'includes/connection.php';

	Utils::doLogout($_SESSION);

?>