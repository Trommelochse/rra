<?php 

require $_SERVER['DOCUMENT_ROOT'].'/rra/includes/connection.php';
require $_SERVER['DOCUMENT_ROOT'].'/rra/includes/verifylogin.php';
require $_SERVER['DOCUMENT_ROOT'].'/rra/includes/getuserdata.php';

include $_SERVER['DOCUMENT_ROOT'].'/rra/functions/printfunctions.php';



if (isset($_GET['postid'])) {
	$postid = $_GET['postid'];
	$get_sql = $con->query("SELECT * FROM requests WHERE id = '{$postid}'");
	$rdata = $get_sql->fetch_assoc();	
}

if (isset($_POST['update'])) {
	$query = "UPDATE requests SET title = '{$_POST['title']}', description = '{$_POST['description']}', start_date = '{$_POST['start_date']}', end_date = '{$_POST['end_date']}', approval_deadline = '{$_POST['approval_deadline']}', markets = '{$_POST['markets']}', products = '{$_POST['products']}'  WHERE id = '{$postid}'";
	//$query = "UPDATE requests SET title = '{$_POST['title']}' WHERE id = '{$postid}'";
	if($post_sql = $con->query($query)) {
		header('Location: ../allrequests.php');
	}

}


 ?>
 <!DOCTYPE html>
 <html lang="en">
 	<head>
 		<title>Edit Request</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="/rra/css/main.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	
 	</head>
 	<body>
 		 <div class="nav-container clearfix">
 			<a href="../requiredactions.php" class="nav-item">Required Actions</a>
 			<a href="../request.php" class="nav-item">Request</a>
 			<a href="../approve.php" class="nav-item">Approve</a>
 			<a href="../allrequests.php" class="nav-item">View all Requests</a>
 			<a href="../logout.php" class="nav-item">Logout</a>
 		</div>
 		<div class="info-container clearfix">
 			<div class="user-info">
 				<span>Logged in as: &nbsp;&nbsp;&nbsp;<?php echo get_fullname($userdata['id']); ?></span>
 			</div>
 		</div>
 		<div class="main-container clearfix">
 			<h2>Edit Request</h2>
 				<form action=<?php echo "editpost.php?postid=".$postid ?> method="POST"  id="editform">
 					<div class="input-container-inner">
 						<span class="form-label_text" >Title:</span>
 						<input type="text" required="required" name="title" value=<?php echo '"'.$rdata['title'].'"' ?>>
 					</div>
 					<div class="input-container-inner">
 						<span class="form-label_text">Description:</span>
 						<textarea required="required" name="description" cols="60" rows="15"><?php 
 						echo $rdata['description'];
 						 ?></textarea>
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Promotion Start Date:</span>
 						<input type="date" required="required" name="start_date" value=<?php echo '"'.$rdata['start_date'].'"' ?>>
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Promotion End Date:</span>
 						<input type="date" required="required" name="end_date" value=<?php echo '"'.$rdata['end_date'].'"' ?>>
 					</div>
 					<div class="input-container-inner third">
 						<span class="form-label_text">Approval Deadline:</span>
 						<input type="date" required="required" name="approval_deadline" value=<?php echo '"'.$rdata['approval_deadline'].'"' ?>>
 					</div>
 					<div class="input-container-inner half">
 						<span class="form-label_text">Markets:</span>
 						<label>EN <input type="checkbox" class="market-box" name="markets_en" value="en"></label>
 						<label>SV <input type="checkbox" class="market-box" name="markets_sv" value="sv"></label>
 						<label>NO <input type="checkbox" class="market-box" name="markets_no" value="no"></label>
 						<label>FI <input type="checkbox" class="market-box" name="markets_fi" value="fi"></label>
 						<label>DK <input type="checkbox" class="market-box" name="markets_da" value="da"></label>
 						<label>DE <input type="checkbox" class="market-box" name="markets_de" value="de"></label>
 						<input type="hidden" name="markets" id="markets" value=<?php echo '"'.$rdata['markets'].'"' ?>>
 					</div>
 					<div class="input-container-inner half">
 						<span class="form-label_text">Products:</span>
 						<label>SB <input type="checkbox" class="product-box" name="products_sb" value="sb" ></label>
 						<label>CA <input type="checkbox" class="product-box" name="products_ca" value="ca"></label>
 						<label>PK <input type="checkbox" class="product-box" name="products_pk" value="pk"></label>
 						<label>MX <input type="checkbox" class="product-box" name="products_mx" value="mx"></label>
 						<input type="hidden" id="products" name="products" value=<?php echo '"'.$rdata['products'].'"' ?>>
 					</div>
 					<br>
 					<div class="input-container-inner">
 						<input type="submit" value="update Request" name="update" id="updaterequest">
 					</div>
 				</form> 				
 		</div>
 		<script type="text/javascript">
 		var markets = $('#markets').val();
 		markets = markets.split(', ');
 		$('.market-box').each(function(){
 			let val = $(this).attr('value');
 			if(markets.indexOf(val) !== -1) {
 				$(this).attr('checked', '1');
 			}
 		});
 		var products = $('#products').val();
 		products = products.split(', ');
 		$('.product-box').each(function(){
 			let val = $(this).attr('value');
 			if(products.indexOf(val) !== -1) {
 				$(this).attr('checked', '1');
 			}
 		});



 		// Create hidden form fields and submit form
 		$('#editform').submit(function(){
			let markets = [];
 			$('.market-box').each(function(){
 				if ($(this).is(':checked')) {
 					markets.push($(this).val());
 				}
 			});
 			markets = markets.join(', ');
			$('#markets').val(markets);
			let products = [];
			$('.product-box').each(function(){
				if ($(this).is(':checked')) {
					products.push($(this).val());
				}
			});
			products = products.join(', ');
			$('#products').val(products);
 			return true
 		});
 			
 		</script>
 	</body> 	
 </html>