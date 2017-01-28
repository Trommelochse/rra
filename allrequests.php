<?php 

require 'includes/connection.php';
require 'includes/verifylogin.php';
require 'includes/getuserdata.php';

include 'functions/printfunctions.php';

$query_offset = '0';
$query = "SELECT * FROM requests ORDER BY id DESC LIMIT 25 OFFSET ".$query_offset;
$result = $con -> query($query);


 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Account Information</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
 	</head>
 	<body>
 		<div class="nav-container clearfix">
 			<a href="requiredactions.php" class="nav-item">Required Actions</a>
 			<a href="request.php" class="nav-item">Request</a>
 			<a href="approve.php" class="nav-item">Approve</a>
 			<a href="allrequests.php" class="nav-item">View all Requests</a>
 			<a href="logout.php" class="nav-item">Logout</a>
 		</div>
 		<div class="info-container clearfix">
 			<div class="user-info">
 				<span><?php echo $userdata['first_name']; ?></span>
 			</div>
 			<div class="user-info">
 				<span><?php echo $userdata['last_name']; ?></span>
 			</div>
 			<div class="user-info">
 				<span><?php echo $userdata['email']; ?></span>
 			</div>
 		</div>
 		<div class="main-container">
 			<h3>All Requests</h3>
 			<?php 
				while($rra = $result->fetch_assoc()) {
					$fullname = get_fullname($rra['author_id']);
					echo '<div class="request-container clearfix">';
 						echo '<div class="request-author-container">';
 							echo '<span>Request ID: '.$rra['id'].'</span>';
 							echo '<span>Request Author : '.$fullname.' </span>';
 							$datestamp = substr($rra['timestamp'], 0, 10);
 							echo '<span>Request Date: '.$datestamp.'</span>';
 						echo '</div>';
 						echo '<div class="request-info-container clearfix">';
 							echo '<div class="request-info-container_markets"><h4>Markets</h4>';
 							echo '<p>'.$rra['markets'].'</p>';
 							echo '</div>';
 							echo '<div class="request-info-container_short"><h4>'.$rra['title'].'</h4>';
 							echo '<p>'.$rra['description'].'</p></div>';
 							echo '<div class="request-info-container_dates">';
 							echo '<p>Start Promotion:<br>'.$rra['start_date'].'</p>';
 							echo '<p>End Promotion:<br>'.$rra['end_date'].'</p>';
 							echo '</div>';
 						echo '</div>';
 					if ($rra['author_id'] == $userdata['id']) {
 						echo '<div class="request-option-container">';
							echo '<a href="postoptions/editpost.php?postid='.$rra['id'].'">Edit</a>';
 						echo '</div>';
 					}
 					echo '</div>';

				}
 			 ?>
 						<?php 

			

			 ?>
 		</div>
 	</body> 	
 </html>