<?php 

$query = "SELECT * FROM users WHERE id = '{$user_id}'";
$sql = $con->query($query);
$userdata = $sql->fetch_assoc();

 ?>