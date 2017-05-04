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


?>

<div class="wrapper">
	<div id="stream">
		<table id="tab">
				<thead>
					<tr>
						<th>Post ID</th>
						<th>Title</th>
						<th>Content</th>
						<th>Date Posted</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$postList = Utils::fetchPost($conn); 
						echo $postList;
					?>
          		</tbody>
			</table>
	</div>
</div>


<?php
	
	include 'includes/footer.php';

?>