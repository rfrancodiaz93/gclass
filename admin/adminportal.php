<?php

	require 'adminheader.php';
	//session_destroy();
	if(!isset($_SESSION)){
		session_start();
		//echo "new session has been started <br>";
	}else{
		echo "new session was not started <br>";
	}
	if(isset($_SESSION['title'])){
		echo "". $_SESSION['title']." has been uploaded";
	}else{
		echo "session variable was not set ";
	}
?>

<!--
	$_SESSION['username']
-->


<div class="portalmainwrapper" >
	<div class="portalheader">
		<div class="logotext">GClass Admin Portal</div>
		<a class=" lsnmanager " href="./lsnmanager.php">Lesson Manager</a>
		<form action="../Includes/logout.inc.php" method="post" class="logoutform">
			<button class="lgoutbtn">Logout</button>
		</form>
	</div>
	
		<form class="lsnform" action="../Includes/lsnupload.inc.php" method="post" enctype="multipart/form-data">
			<div class="inputwrapper">
				Title:
				<input class="blt taglsninput taglsntextbox taglsntitle" <?php if(isset($_SESSION['title'])) echo 'value="'.$_SESSION['title'].'"';?>  type="text" name="lsntitle" >
			</div>

			<div class="inputwrapper">
				Upload:
				<input class="blt taglsninput taglsnupload" type="file" name="lsnvid" accept="video/*" >
			</div>
			<div class="inputwrapper">
				Thumbnail:
				<input  class="blt taglsninput taglsnthumbnail "  type="file" name="lsnthumbnail" accept="image/png, image/jpeg, image/jpg">
				
			</div>
			<div class="inputwrapper tawrapper">
				Instruction:<br>
				<textarea class="taglsninput textarea" placeholder="Insert text here!" name="lsninstruction"><?php if(isset($_SESSION['instructions'])) echo ''.$_SESSION['instructions'];?></textarea>
			</div>
			
			<div class="atbtnwrapper">
				<button class="atbtn"></button>
				<input type="file" class="himg" name="lsnimages[]" accept="image/png, image/jpeg, image/jpg" multiple>
			</div>

			<input type="submit" class="fbtns taglsninput lsnbtn taglsnsub" name="submit" value="Publish">
		</form>
	
</div>



<?php
	require 'footer.php';

?>

