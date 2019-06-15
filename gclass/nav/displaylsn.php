<?php
require "../../Includes/dbh.inc.php";

//$query = mysqli_query($con,"SELECT lsntitle, lsninstruction, videoname, videourl, thumbnailname, thumbnailurl FROM lsnTNI, lsnattachment, lsnthumbnail, lsnvideos ");

//first query
$query = mysqli_query($con, "SELECT lsntitle, lsninstruction FROM lsnTNI");

//array for the lesson title
$lsnTitleArray = array();


while ($data = mysqli_fetch_assoc($query)) {
	$lsnTitleArray[] = $data;
}//end of while loop
//print_r($lsnTitleArray);
//echo "".$lsnTitleArray[1]['lsntitle'];

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
	/*echo "".$i."Title present: ".$lsnTitleArray[$i]['lsntitle']."<br>".
		"".$i."Lesson instruction: ".$lsnTitleArray[$i]['lsninstruction']."<br>".
		"".$i."Video name: ". $lsnVideoArray[$i]['videoname']."<br>".
		"".$i."Video Url: ". $lsnVideoArray[$i]['videourl']."<br>".
		"".$i."Thumbnailname: ". $lsnThumbnailArray[$i]['thumbnailname']."<br>".
		"".$i."Thumbnailurl: ".$lsnThumbnailArray[$i]['thumbnailurl']."<br>".
		"".$i."Attachmentname: ".$lsnAttachmentArray[$i]['attachmentname']."<br>".
		"".$i."Attachmentur: ".$lsnAttachmentArray[$i]['attachmenturl']."<br><br>";*/
		
		/**** display code ******/
		
	echo'
	<a class="lsnA lsn"  onclick="userclicked('.$i.', \'../videos/'.$lsnVideoArray[$i]['videoname'].'\');" >

		<div class="vidboxes">
			<div class="vidthumbnail " style="background-image: url(\'../'.$lsnThumbnailArray[$i]['thumbnailurl'].'\'"></div>
			<div class="tdwrapper">
				<div class="vidtitle">'.$lsnTitleArray[$i]['lsntitle'].'</div>
				<div class="vidlength "></div>
			</div>
		</div>
	</a>
	
	<div class="instwrapper">
					<button class="cancelbtn" onclick="closeInstView('.$i.');">X</button>

					<div class="chordIcon" style="background-image: url(\'../imgs/'.$lsnAttachmentArray[$i]['attachmentname'].'\')"></div>

					<p class="instText">'.$lsnTitleArray[$i]['lsninstruction'].'</p>
				</div>

	<script>
		function userclicked(ind, vidurl){
			console.log("User click lsn: "+ind);
			openInstView(ind);
			setVid(vidurl)

		}	

		var instWrap, btnCancel, isInstructionOpen, vidContainer, crntVid;

		window.onload = initialize; 

		function initialize(){
			initVars();
			
		}

		function initVars(){
			//instruction view
			instWrap = new Array();
			instWrap = document.getElementsByClassName("instwrapper");
			isInstructionOpen = false;
			btnCancel = new Array();
			btnCancel = document.getElementsByClassName("cancelbtn");

			//video tags
			vidContainer = document.getElementsByClassName("vidtag")[0];
			crntVid = document.getElementsByClassName("currentvideo")[0];
		}

		

		function openInstView(ind){
					//console.log("User opened view: "+i);
					//instWrap[ind].style.cssText = "width: 100%";
					if(!isInstructionOpen){
						instWrap[ind].style.cssText = "width: 100%";
						isInstructionOpen = true;
					}				
				}
		function closeInstView(ind){
					if(isInstructionOpen){
						instWrap[ind].style.cssText = "width: 0";
						isInstructionOpen = false;
						vidContainer.pause();
					}
		}

		function setVid(vidurl){
					nuVidsource = vidurl;
					vidContainer.pause();
					crntVid.setAttribute("src", nuVidsource);
					vidContainer.load();
					//vidContainer.setAttribute("poster", newposter);
					vidContainer.play();
					
					
		}

				
	</script>

	';
		
	}

?>






