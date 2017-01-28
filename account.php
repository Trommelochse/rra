<?php 

require 'includes/connection.php';
require 'includes/verifylogin.php';
require 'includes/getuserdata.php';

header('Location: allrequests.php');

 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Account Information</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
 	</head>
 	<body>
 		<?php 

 		include 'html/nav.html';

 		 ?>
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
 			<h3>Actions required</h3>

 		</div>
 	</body> 	
 </html>