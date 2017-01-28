<?php 

if (!isset($_GET['msg'])) {
	header('Location: index.php');
}

if ($_GET['msg'] == 'request_succ') {
	echo 'Request submited';
}

 ?>
 <script>
 	setTimeout(function(){
 		window.location = 'account.php';
 	}, 2000)
 </script>