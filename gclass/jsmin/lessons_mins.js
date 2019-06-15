var vidthumb, nuVidsource, vidContainer, crntVid, lsnbtn, durMins, durSecs, vidDuration, durMinsString, durSecsString, durTimeString;

// instruction view variables;
var instWrap, btnCancel, instructionText, isInstructionOpen;

window.onload = initializeVars; 
function initializeVars(){

	defineVar();
	eventListeners();

}

function defineVar(){
	vidContainer = document.getElementsByClassName("vidtag")[0];
	vidDurTag = document.getElementsByClassName("vidlength")[0];
	durTimeString = "";
	// change by the lesson
	vidthumb = new Array();
	vidthumb = document.getElementsByClassName("vidthumbnail");
	crntVid = document.getElementsByClassName("currentvideo")[0];
	lsnbtn = new Array();
	lsnbtn = document.getElementsByClassName("lsn");

	//assign variables for instruction view 
	instWrap = document.getElementsByClassName("instwrapper")[0];
	btnCancel = document.getElementsByClassName("cancelbtn")[0];
	instructionText = document.getElementsByClassName("Instructions")[0];
	// chordIcon = document.getElementsByClassName("chordIcon")[0];
	isInstructionOpen = false;

	//assignment thumbnail and css
	//vidthumb['.$i.'].style.cssText = "background-image: url(\'../imgs/'.$lsnThumbnailArray[$i]['thumbnailname'].'\'); background-repeat: no-repeat; background-size: 100% 100%; background-position: center;";

}

function eventListeners(){
	
	vidContainer.addEventListener("loadedmetadata", getVidDur);
	btnCancel.addEventListener("click", closeInstView);
	for(var i = 0; i< lsnbtn.length; i++){
		lsnbtn[i].addEventListener("click", userclicked);
		lsnbtn[i].addEventListener("click", changetovid);
	}
}

function userclicked(){
	console.log("User Clicked ");
}

function changetovid(){
	
	nuVidsource = "../videos/lsn1_chord_am.mp4";
	vidContainer.pause();
	crntVid.setAttribute("src", nuVidsource);
	vidContainer.load();
	//vidContainer.setAttribute("poster", newposter);
	vidContainer.play();
	isInstructionOpen = true;
	openCloseInstView();

}

function getVidDur(){
	vidDuration = vidContainer.duration;
	durMins = Math.floor(vidDuration / 60, 10);
	durSecs = Math.floor(vidDuration % 60);

	if(durMins >= 0 && durMins <= 9){
		durMinsString = "0"+ durMins;
	}else if( durMins > 9){
		durMinsString = durMins;
	}

	if(durSecs >= 0 && durSecs <= 9){
		durSecsString = "0"+ durSecs;
	}else if(durSecs > 9){
		durSecsString = durSecs;
	}

	durTimeString = "" + durMinsString+":"+ durSecsString;
	//vidDurTag.innerHTML = ""+ vidDuration;
	console.log("current video duration: ", durTimeString);
	//assign to video length tag
	console.log("vid time" + durTimeString);
	vidDurTag.innerHTML = ""+ durTimeString;
}

function openCloseInstView(){
	instWrap.style.cssText = "width: 100%";
	if(isInstructionOpen){
		instWrap.style.cssText = "width: 100%";
	}else if(!isInstructionOpen){
		instWrap.style.cssText = "width: 0";
	}
}

function closeInstView(){
	isInstructionOpen = false;
	openCloseInstView();
	vidContainer.pause();
}