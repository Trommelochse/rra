<?php 
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
  header('Location: onie.php');
  die();
} else {
	$con = mysqli_connect('localhost', 'root', '', 'rra');
	session_start();
}



 ?>


