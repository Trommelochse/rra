<?php 

include 'includes/connection.php';

if(isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = hash('sha256', $_POST['password']);
	$query = "SELECT id FROM users WHERE email = '{$email}' AND password = '{$password}'";

	$sql = $con->query($query);
	if ($sql->num_rows) {
		$user = $sql->fetch_assoc();
		$_SESSION['user_id'] = $user['id'];
		header('Location: account.php');
	}
} 

 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Log In</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
 	</head>
 	<body>
 		<div class="login-container">
 			<form action="login.php" method="POST">
 				<div class="input-container-inner">
 					<span class="form-label_text">Email adress:</span>
 					<input type="text" name="email">
 				</div>
 				<div class="input-container-inner">
 					<span class="form-label_text">Password:</span>
 					<input type="password" name="password">
 				</div>
 				<div class="input-container-inner">
 					<input type="submit" value="Login" name="login">
 				</div>
 			</form> 
 			<div class="message-container">
 				<?php 

 				if (isset($_COOKIE['regsuccess'])) {
 					if ($_COOKIE['regsuccess'] == '1') {
 						echo '<p>Registration successful</p>';
 					}
 				} 
 				 ?>
 			</div> 		
 		</div>
 	</body>
 </html>