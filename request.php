<?php 

require 'includes/connection.php';
require 'includes/verifylogin.php';
require 'includes/getuserdata.php';

if ($userdata['rights'] == 'r') {
	header('Location: account.php');
}

// Get approval accounts

$query = "SELECT first_name, last_name, id FROM users WHERE rights = 'a' OR rights ='s'";
$result_users_approval = $con->query($query);

// Submit
if (isset($_POST['submit'])) {
	//echo var_dump($_POST);
	$author_id = $userdata['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$approval_deadline = $_POST['approval_deadline'];
	// create arrays for markets and products
	$markets = $_POST['markets'];
	$products = $_POST['products'];
	$approval_ids = $_POST{'approval_ids'};

	$query = "INSERT INTO requests (author_id, markets, title, description ,products, start_date, end_date, approval_deadline, approval_ids) VALUES ('{$author_id}', '{$markets}', '{$title}', '{$description}', '{$products}', '{$start_date}', '{$end_date}', '{$approval_deadline}', '{$approval_ids}')";
	if ($con->query($query)) {
		header('Location: status.php?msg=request_succ');
	}
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Request new Promotion</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	
 	</head>
 	<body>
 		<?php 

 		include 'html/nav.html';

 		 ?>
 		<div class="info-container clearfix">
 			<div class="user-info">
 				<span>Logged in as: &nbsp;&nbsp;&nbsp;<?php echo $userdata['first_name'].' '.$userdata['last_name']; ?></span>
 			</div>
 		</div>
 		<div class="main-container clearfix">
 			<h2>New Request</h2>
 				<form action="request.php" method="POST"  id="requestform">
 					<div class="input-container-inner">
 						<span class="form-label_text" >Title:</span>
 						<input type="text" required="required" name="title">
 					</div>
 					<div class="input-container-inner">
 						<span class="form-label_text">Description:</span>
 						<textarea required="required" name="description" cols="60" rows="15"></textarea>
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Promotion Start Date:</span>
 						<input type="date" required="required" name="start_date">
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Promotion End Date:</span>
 						<input type="date" required="required" name="end_date">
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Approval Deadline:</span>
 						<input type="date" required="required" name="approval_deadline">
 					</div>
 					<div class="input-container-inner half">
 						<span class="form-label_text">Markets:</span>
 						<label>EN <input type="checkbox" class="market-box" name="markets_en" value="en" checked></label>
 						<label>SV <input type="checkbox" class="market-box" name="markets_sv" value="sv" checked></label>
 						<label>NO <input type="checkbox" class="market-box" name="markets_no" value="no" checked></label>
 						<label>FI <input type="checkbox" class="market-box" name="markets_fi" value="fi" checked></label>
 						<label>DK <input type="checkbox" class="market-box" name="markets_da" value="da"></label>
 						<label>DE <input type="checkbox" class="market-box" name="markets_de" value="de"></label>
 					</div>
 					<div class="input-container-inner half">
 						<span class="form-label_text">Products:</span>
 						<label>SB <input type="checkbox" class="product-box" name="products_sb" value="sb" checked></label>
 						<label>CA <input type="checkbox" class="product-box" name="products_ca" value="ca"></label>
 						<label>PK <input type="checkbox" class="product-box" name="products_pk" value="pk"></label>
 						<label>MX <input type="checkbox" class="product-box" name="products_mx" value="mx"></label>
 					</div>
 					<div class="input-container-inner ">
 						<span class="form-label_text">Choose approving people:</span>
						<?php 

						while ($user = $result_users_approval->fetch_assoc()) {
							$ufn = $user['first_name'];
							$uln = $user['last_name'];
							$uid = $user['id'];
							// if statement <- you cannot approve yourself
							if ($uid != $_SESSION['user_id']){
								echo '<label>'.$ufn.' '.$uln.' <input type="checkbox" class="approval-box" value="'.$uid.'"></label>';
							}							
						}
						 ?> 						
 					</div>
 					<br>
 					<div class="input-container-inner">
 						<input type="submit" value="Submit Request" name="submit" id="submitrequest">
 					</div>
 				</form> 				
 		</div>
 		<script type="text/javascript">
 			$('#requestform').submit(function(){
				let markets = [];
 				$('.market-box').each(function(){
 					if ($(this).is(':checked')) {
 						markets.push($(this).val());
 					}
 				});
 				markets = markets.join(', ');

 				$('<input type="hidden" name="markets">').val(markets).appendTo('#requestform');
 				let products = [];
 				$('.product-box').each(function(){
 					if ($(this).is(':checked')) {
 						products.push($(this).val());
 					}
 				});
 				products = products.join(', ');
 				$('<input type="hidden" name="products">').val(products).appendTo('#requestform');

 				let approvalUsers = [];
 				$('.approval-box').each(function(){
 					if ($(this).is(':checked')) {
 						approvalUsers.push($(this).val());
 					}
 				});
 				approvalUsers = approvalUsers.join(', ');
 				$('<input type="hidden" name="approval_ids">').val(approvalUsers).appendTo('#requestform');
 				return true
 			});
 			
 		</script>
 	</body> 	
 </html>