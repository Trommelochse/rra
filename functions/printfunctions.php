<?php 

function get_fullname($id) {
	global $con;
	$sql = $con->query("SELECT first_name, last_name FROM users WHERE id = '{$id}'");
	$user = $sql->fetch_assoc();
	return $user['first_name'].' '.$user['last_name'];
}

 ?>