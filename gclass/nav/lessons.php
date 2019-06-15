<?php


?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>GClass</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Mobile, Guitar, How, Play, Class, Game">
	<meta name="description" content="Mobile app where you learn to play guitar through video lesson and game exercises">
	<meta name="robots" content="index,follow">
	<!--link files-->
	<!--<script src="../jsmin/lessons_mins.js"></script>-->
	<link rel="stylesheet" type="text/css" href="../css/lessons_style.css">

	
</head>
<body >
	<div class="mainwrapper">
		<div class="headerwrapper">
			<div class="tabbackground">
				<div class="lclogo">GClass</div>
				<div class="lctitle">Lessons</div>
				<a class="backbtn" href="../home.php">Back</a>
			</div>
		</div>
		<video class="vidtag" controls>
			<source class="currentvideo"  src="../videos/introvideo.mp4" type="video/mp4" >
		</video>
		
		<div class="vidwrapper">
			<div class="vidsliderwrapper">

				<?php
					require 'displaylsn.php';
				?>
				

				

			</div>
		</div>
	</div>


	<footer>FDZ WEBS &copy; Copryright 2019</footer>
</body>
</html>