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
	<script src="jsmin/main.js"></script>
	<script src="jsmin/swregistration.js"></script>
	<script src="sw.js"></script>
	

	<style type="text/css">
	.mainwrapper{
		position: absolute;
		top: 25%;
		width: 80%;
		margin: 0 10%;
	}
	.logo{
		
		margin: 0  40%;
		background-image: url("imgs/GClasslogo.png");
		background-repeat: no-repeat;
		background-position: center;
		background-size: 100% 100%;
		width: 20%;
		height: 125px;

	}
	.btns{
		display: block;
		margin: 4% 40% 0 40%;
		width: 20%;
		display: block;
		font-size: 30px;
		color: white;
		text-decoration: none;
		text-align: center;
		border: 2px solid white;
		border-radius: 4px;
		background-color: blue;
		padding: 0.5% 0;
		transition: width 1s, margin 1s;
		
	}
	.btns:hover{
		color: grey;
		background-color: darkblue;
		margin: 4% 37.5% 0 37.5%;
		width: 25%; 
	}

	body,html{
		margin: 0;
		padding: 0;
		widows: 100%;
		height: 100%;
		min-height: 500px;
		min-width: 300px;

	}
	body{

		background-color: black; 
		background-image: url("imgs/crowd.png");
		background-repeat: no-repeat;
		background-size: 100% 100%;
		background-position: center;
		color: white;
		margin: 0;
		padding: 0;

	}
	footer{
		position: absolute;
		width: 100%;
		text-align: center;
		bottom: 0;
		margin: 0 0 5% 0;
		font-size: 17px;

		
		padding: 3% 0 0 0;

	}
	@media only screen and (max-width: 700px){
		.mainwrapper{
			position: absolute;
			top: 25%;
			width: 80%;
			margin: 0 10%;
		}

		.logo{
		
			margin: 0  30%;
			width: 40%;
			height: 125px;

		}
		.btns{
			margin: 4% 20% 0 20%;
			width: 60%;
		}
	}
	</style>
</head>
<body >
	<div class="mainwrapper">
	
		<div class="logo"></div>

		<a class="btns" href="nav/lessons.php">Lessons</a>
		
	</div>

	<footer>FDZ WEBS &copy; Copryright 2019</footer>
</body>
</html>