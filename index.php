<?php 

include 'includes/connection.php';
include 'includes/verifylogin.php';

if (isset($_SESSION['user_id'])) {
	header('Location: allrequests.php');
}

 ?>