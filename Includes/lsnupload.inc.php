<?php
//session_start();
if(isset($_POST['submit'])){

	require 'dbh.inc.php';
	//$handle = fopen($_FILES["UploadFileName"]["tmp_name"], 'r');

	$lessonTitle = $_POST['lsntitle'];
	$lessonInstruction = $_POST['lsninstruction'];
	$lessonid = 1;

	//get the path of the files
	//$vidPath = realpath($_FILES['lsnvid']['tmp_name']);
	
	//video data
	$lessonVideo = $_FILES['lsnvid'];
	$lessonVideoName = $_FILES['lsnvid']['name'];
	$lessonVideoTmpName = $_FILES['lsnvid']['tmp_name'];
	$lessonVideoSize = $_FILES['lsnvid']['size'];
	$lessonVideoError = $_FILES['lsnvid']['error'];
	$lessonVideoType = $_FILES['lsnvid']['type'];

	//path for the video to be uploaded
	$videoDest = "../gclass/videos/".$lessonVideoName;

	//thumbnail
	$lessonThumbnail = $_FILES['lsnthumbnail'];
	$lessonThumbnailName = $_FILES['lsnthumbnail']['name'];
	$lessonThumbnailTmpName = $_FILES['lsnthumbnail']['tmp_name'];
	$lessonThumbnailSize = $_FILES['lsnthumbnail']['size'];
	$lessonThumbnailError = $_FILES['lsnthumbnail']['error'];
	$lessonThumbnailType = $_FILES['lsnthumbnail']['type'];

	//path for the thumbnail to be uploaded
	$thumbnailDest = "../gclass/imgs/".$lessonThumbnailName;
	
	//Attachments
	$lessonAttachments = $_FILES['lsnimages'];
	$lessonAttachmentsName = $_FILES['lsnimages']['name'];
	$lessonAttachmentsTmpName = $_FILES['lsnimages']['tmp_name'];
	$lessonAttachmentsSize = $_FILES['lsnimages']['size'];
	$lessonAttachmentsError = $_FILES['lsnimages']['error'];
	$lessonAttachmentsType = $_FILES['lsnimages']['type'];

	//path for the pictures in the lesson
	$attachmentsDest;
	$attachCount = count($lessonAttachmentsName);
	for($i = 0; $i< $attachCount; $i++){
		$attachmentsDest[$i] = "../gclass/imgs/".$lessonAttachmentsName[$i];
	}
	
	if(empty($lessonTitle) || empty($lessonVideo) || empty($lessonThumbnail) ||
		empty($lessonInstruction)){

		/*$redirect = "Location: ../admin/adminportal.php?error=emptyfields&lsntitle".$lessonTitle."&lsnvid".$lessonVideo."&lsnthumbnail".$lessonThumbnail."&lsninstruction".$lessonInstruction."&lsnimages".$lessonAttachments;
		echo "user has empty fields";*/
		
		//start session to return data to the variables title and instruction
		/*session_start();
		$_SESSION['title'] = $lessonTitle;
		$_SESSION['instructions'] = $lessonInstruction;*/
		header("Location: ../admin/adminportal.php?error=emptyfields");
		exit();

	}// end of check for empty fields
	else{

		

		
		//create sql query to store the title and instructions
		$sql = "INSERT INTO lsnTNI (lsntitle, lsninstruction, group_id) VALUES (?,?,?)";
		$stmt = mysqli_stmt_init($con);
		
		// check for query request
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../admin/adminportal.php?error=sqlnogood");
			exit();
		}// end of check for query request for prepared a statements
		else{
			
			mysqli_stmt_bind_param($stmt, "sss", $lessonTitle, $lessonInstruction,$lessonTitle );
			mysqli_stmt_execute($stmt);

			session_start();
			$_SESSION['title'] = $lessonTitle;
			$_SESSION['instructions'] = $lessonInstruction;

			/*header("Location: ../admin/adminportal.php?upload=success");
			exit();*/
		}// end of uploading title and instruction

		if(move_uploaded_file($lessonVideoTmpName, $videoDest)){
			//absolute path of the video location
			$url = "http://localhost:8888/webs/phpwebs/w001/site/gclass/videos/$lessonVideoName";

			//check for query request
			//create sql query to store the video
			$sql = "INSERT INTO lsnvideos (videoname, videourl, group_id) VALUES (?,?,?)";
			$stmt = mysqli_stmt_init($con);
			
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../admin/adminportal.php?error=sqlnogood");
				exit();
				
			}else{
				mysqli_stmt_bind_param($stmt, "sss", $lessonVideoName, $url, $lessonTitle);
				mysqli_stmt_execute($stmt);

			}//end of inserting video name and url
		}//end of uploading video file
		
		if(move_uploaded_file($lessonThumbnailTmpName, $thumbnailDest)){
			//create sql query to store the thumbnail
			$sql = "INSERT INTO lsnthumbnail (thumbnailname, thumbnailurl, group_id) VALUES (?,?,?)";
			$stmt = mysqli_stmt_init($con);
			
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../admin/adminportal.php?error=sqlnogood");
				exit();
				
			}else{
				mysqli_stmt_bind_param($stmt, "sss", $lessonThumbnailName, $thumbnailDest, $lessonTitle);
				mysqli_stmt_execute($stmt);

			}
		}

		
		/*if(move_uploaded_file($lessonAttachmentsTmpName[$i], $attachmentsDest[$i])){	
			for( $i = 0; $i < $attachCount; $i++){
				$url = "http://localhost:8888/webs/phpwebs/w001/site/gclass/imgs/$lessonAttachmentsName[$i]";
			//create sql query to store the attachments
				$sql = "INSERT INTO lsnattachment (attachmentname, attachmenturl) VALUES (?,?)";
				$stmt = mysqli_stmt_init($con);

				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../admin/adminportal.php?error=sqlnogood");
					exit();
					
				}else{
					mysqli_stmt_bind_param($stmt, "ss", $lessonAttachmentsName[$i], $url[$i]);
					mysqli_stmt_execute($stmt);

					echo "so far so good!";

					header("Location: ../admin/adminportal.php?upload=success");
					exit();
				}//thumbnails 
			
			}// end of foor loop for thumbnails
		}//end of upload method*/

		/*$i;
		for( $i = 0; $i < $attachCount; $i++){
			move_uploaded_file($lessonAttachmentsTmpName[$i], $attachmentsDest[$i]);
		}//end of foor loop for thumbnails

		$url = "http://localhost:8888/webs/phpwebs/w001/site/gclass/imgs/$lessonAttachmentsName[$i]";
		//create sql query to store the attachments
				$sql = "INSERT INTO lsnattachment (attachmentname, attachmenturl) VALUES (?,?)";
				$stmt = mysqli_stmt_init($con);

				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../admin/adminportal.php?error=sqlnogood");
					exit();
					
				}else{
					mysqli_stmt_bind_param($stmt, "ss", $lessonAttachmentsName[$i], $url[$i]);
					mysqli_stmt_execute($stmt);

					echo "so far so good!";

					header("Location: ../admin/adminportal.php?upload=success");
					exit();
				}//thumbnails */

		//
		
		    
		    for ($i=0; $i<count($lessonAttachmentsName); $i++) {
		    	$path = "../gclass/imgs/".$lessonAttachmentsName[$i];
		    	$url = "http://localhost:8888/webs/phpwebs/w001/site/gclass/imgs/$lessonAttachmentsName[$i]";
		    	$attachmentname = $lessonAttachmentsTmpName[$i];
		        if(move_uploaded_file($attachmentname, $path)){
		        	$attachActualName = $lessonAttachmentsName[$i];
			        $sql = "INSERT INTO lsnattachment (attachmentname, attachmenturl, group_id) VALUES ('$attachActualName','$url', '$lessonTitle')";
				    $res = mysqli_query($con,$sql);
				}//end of upload attachment to fold and database
		    }// end of foor loop
		    
		    

			//header("Location: ../admin/adminportal.php?upload=success");
			header("Location: ../admin/adminportal.php?upload=success");
			exit();

	} // end of uploading files

}


























