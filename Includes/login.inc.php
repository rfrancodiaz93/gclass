<?php

//check if user clicked login button
if(isset($_POST['login-submit'])){

	//connect to the database
	require 'dbh.inc.php';


	//retreived user input
	$userEmailOrName = $_POST['tagemailorusername'];
	$password = $_POST['pwd'];

	
	//check if any of the input boxes are empty
	if(empty($userEmailOrName) || empty($password)){
		header("Location: ../admin/adminlogin.php?error=emptyfields");
		exit();
	}//end of check for empty fields
	
	else{
		//create variables with query statements
		// & wrapped them
		$sqlLoginUser = "SELECT * FROM userAccount WHERE username=? OR useremail=?;";
		$stmt = mysqli_stmt_init($con);
		
		if(!mysqli_stmt_prepare($stmt, $sqlLoginUser)){
			header("Location: ../admin/adminlogin.php?error=sqlerrorstmtnotprepared");
			exit();

		}//End of check if statement was prepared		
		else{

			//if connection to server and query are fine 
			// proceed on executing the statement
			// and retrieve result
			mysqli_stmt_bind_param($stmt,"ss", $userEmailOrName, $userEmailOrName);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			//check if the results was retrieved successfully
			if($row=mysqli_fetch_assoc($result)){

				//check if the password that inserted
				//matched with the password in the database
				$pwdCheck = password_verify($password, $row['userpwd']);

				//check if password is correct
				if($pwdCheck == true){
					header("Location: ../admin/adminlogin.php?error=wrongpwda");
					exit();
				}// end of if wrong pwd
				else if($pwdCheck == false){
					//start session
					// this is convinience and safety
					session_start();
					$_SESSION['userid'] = $row['userid'];
					$_SESSION['username'] = $row['username'];

					header("Location: ../admin/adminportal.php?login=success");
					exit();

				}// end of check for correct login pwd
				else{
					header("Location: ../admin/adminlogin.php?error=wrongpwdb");
					exit();
				}// end notify user of wrong pwd

			}//end of fetch for user data 
			
			else{
				header("Location: ../admin/adminlogin.php?error=nouser");
				exit();
			}

		}// end of execution of query statement
		
	}// end of check if user input is correct or not
}// end of check if login button was pressed
else{
	header("Location: ../admin/adminlogin.php");
	exit();
}