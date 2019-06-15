
<!DOCTYPE html>
<html>
<head>
	<title>GCAdmin | LSNManager</title>

	 <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta charset="utf-8" http-equiv="enconding">

    <meta name="apple-mobile-web-app-capble" content="yes">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="FDZ WEBS">
    <link rel="stylesheet" type="text/css" href="./css/lsnmanagerstyle.css">
   
</head>
<body>
	<div class="mainwrapper">
		<a class="back" href="./adminportal.php">Back</a>
		<?php
		session_start();
		//check if user is logged in
		if(isset($_SESSION['username'])){
			require "../Includes/dbh.inc.php";
			//echo "User logged in.";

			//first query
			$query = mysqli_query($con, "SELECT lsntitle, lsninstruction FROM lsnTNI");

			//array for the lesson title
			$lsnTitleArray = array();


			while ($data = mysqli_fetch_assoc($query)) {
				$lsnTitleArray[] = $data;
			}//end of while loop

			//second query
			$query2 = mysqli_query($con, "SELECT videoname, videourl FROM lsnvideos");

			//array for the lesson title
			$lsnVideoArray = array();


			while ($data = mysqli_fetch_assoc($query2)) {
				$lsnVideoArray[] = $data;
			}//end of while loop

			//third query
			$query3 = mysqli_query($con, "SELECT thumbnailname, thumbnailurl FROM lsnthumbnail");

			//array for the lesson title
			$lsnThumbnailArray = array();


			while ($data = mysqli_fetch_assoc($query3)) {
				$lsnThumbnailArray[] = $data;
			}//end of while loop

			//fourth query
			$query4 = mysqli_query($con, "SELECT attachmentname, attachmenturl, group_id FROM lsnattachment");

			//array for the lesson title
			$lsnAttachmentArray = array();


			while ($data = mysqli_fetch_assoc($query4)) {
				$lsnAttachmentArray[] = $data;
			}//end of while loop

			$lsnArray = array();
			$lsnArray = array_merge($lsnTitleArray, $lsnVideoArray, $lsnThumbnailArray, $lsnAttachmentArray);

			//print all the data
			$titlecount = count($lsnTitleArray);
			
			for($i = 0; $i < $titlecount ; $i++){

			echo '<form method="post" class="lsnwrapper" >';
				echo '<div class="title">'."<input class='hideinput' type='text' name='index' value='".$i."'>"."Title present: ".$lsnTitleArray[$i]["lsntitle"]."</div>";
				echo '<input type="submit" class="delete" name="submit" value="Delete">';
				/*echo "".$i."Title present: ".$lsnTitleArray[$i]["lsntitle"]."<br>".
					"".$i."Lesson instruction: ".$lsnTitleArray[$i]["lsninstruction"]."<br>".
					"".$i."Video name: ". $lsnVideoArray[$i]["videoname"]."<br>".
					"".$i."Video Url: ". $lsnVideoArray[$i]["videourl"]."<br>".
					"".$i."Thumbnailname: ". $lsnThumbnailArray[$i]["thumbnailname"]."<br>".
					"".$i."Thumbnailurl: ".$lsnThumbnailArray[$i]["thumbnailurl"]."<br>".
					"".$i."Attachmentname: ".$lsnAttachmentArray[$i]["attachmentname"]."<br>".
					"".$i."Attachmentur: ".$lsnAttachmentArray[$i]["attachmenturl"]."<br><br>";*/
							
				echo'</form>';
				echo'<script>
					function userclicked(ind){
						console.log("user clicked: "+ind);
					}
				</script>
				';
			}


		}// End of check if user is logged in
		else{
			echo "User not logged in.";
			header("Location: ./adminlogin.php");
			exit();
		}
		?>
	</div>

	<?php
		
		if(isset($_POST['index'])){
			$index = $_POST['index'];
			 require "../Includes/dbh.inc.php";

			 $query5 = mysqli_query($con, "SELECT lsntitle, lsninstruction, group_id FROM lsnTNI");

			//array for the lesson title
			$group_id = array();


			while ($data = mysqli_fetch_assoc($query5)) {
				$group_id[] = $data;
			}//end of while loop

			$lsnCount= count($group_id);
			for ($i=0; $i < $lsnCount ; $i++) { 
				if($index == $i){
					$delGroup = $group_id[$i]['group_id'];
					mysqli_query($con,"START TRANSACTION");

					$queryA = mysqli_query($con,"DELETE FROM lsnTNI where group_id = '$delGroup'");
					$queryB = mysqli_query($con,"DELETE FROM lsnattachment where group_id = '$delGroup'");
					$queryC = mysqli_query($con,"DELETE FROM lsnthumbnail where group_id = '$delGroup'");
					$queryD = mysqli_query($con,"DELETE FROM lsnvideos where group_id = '$delGroup'");

					if ($queryA && $queryB && $queryC && $queryD) {
					   mysqli_query($con,"COMMIT"); //Commits the current transaction
					   echo "Lesson: \"".$delGroup."\" was deleted";
					   header("Refresh:0");
					   exit();
					} else {        
					   mysqli_query($con,"ROLLBACK");//Even if any one of the query fails, the changes will be undone
					   echo "query issues";
					}
				}
			}



		}
	 ?>
		
	<footer>FDZ WEBS &copy; 2019</footer>
</body>
</html>