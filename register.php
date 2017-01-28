<?php 

include 'includes/connection.php';

// Registration process

if (isset($_POST['register'])) {
	// check if email exists
	$email = $_POST['email'];	
	$checkresult = $con->query("SELECT * FROM users WHERE email = '{$email}'");
	if ($checkresult->num_rows) {
		setcookie('userexists', '1', time() + 60);
		header('Location: register.php');
	} else {
		ob_start();
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$password = $_POST['password'];
		$password_hash = hash('sha256', $password);
		$rights = $_POST['rights'];
		$sql = $con->query("INSERT INTO users (first_name, last_name, email, password, rights) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$password_hash}', '{$rights}')");
		setcookie('regsuccess' , '1', time() + 10);
		ob_end_flush();
		header('Location: login.php');
	}	
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Register</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
 	</head>
 	<body>
 		<div class="login-container">
 			<form action="register.php" method="POST">
 				<div class="input-container-inner">
 					<span class="form-label_text">First Name:</span>
 					<input type="text" required="required" name="first_name">
 				</div>
				<div class="input-container-inner">
 					<span class="form-label_text">Last name:</span>
 					<input type="text" required="required" name="last_name">
 				</div>
 				<div class="input-container-inner">
 					<span class="form-label_text">Email adress:</span>
 					<input type="text" required="required" name="email">
 				</div>
 				<div class="input-container-inner">
 					<span class="form-label_text">Password:</span>
 					<input type="password" required="required" name="password">
 				</div>
 				<div class="input-container-inner">
 					<span class="form-label_text">Rights:</span>
 					<div class="flex-space-center">
 						<label>Request<input type="radio" name="rights" value="r" checked required="required"></label>
 						<label>Approve<input type="radio" name="rights" value="a"></label>
 						<label>Both<input type="radio" name="rights" value="s"></label>
 					</div> 					
 				</div>
 				<div class="input-container-inner">
 					<input type="submit" value="Register" name="register">
 				</div>
 			</form>
 			<div class="message-container">
 				<?php 

 				if (isset($_COOKIE['userexists'])) {
 					if ($_COOKIE['userexists'] == '1') {
 						echo '<p>User already exists</p>';
 					}
 				} 
 				 ?>
 			</div> 	
 		</div>
 	</body>
 </html>