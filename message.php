<?php 

if (isset($msg = $_GET('msg'))) {
	if ($msg = 'us') {
		echo 'Update successful';
	}
}

 ?>
 <script>
 	setTimeout(function(){
 		window.location = '/allrequests.php';
 	}, 2750);
 </script>