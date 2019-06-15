<?php

	require "adminheader.php";
	

?> 


	
<?php
	if(!isset($_SESSION['username'])){

		echo '
			<div class="loginformwrapper">
				<div class="logo"></div>
				<form action="../Includes/login.inc.php" method="post" class="loginForm ">
					<div class="simpletext">Admin Login</div>
					<input class="textinput username"  type="text" name="tagemailorusername" placeholder="Username/Email">
					<input class="textinput password" type="password" name="pwd" placeholder="password">
					<button type="submit" name="login-submit" class="loginbtn btns">Login</button>
				</form>
			</div>
		

		';

	}else{

		echo '
			
			<script>
				window.location.href="http://localhost:8888/webs/phpwebs/w001/site/admin/adminportal.php"; 
			</script>
		

		';
		//require "adminportal.php";
	}
?>


<?php
	require "footer.php";

?>