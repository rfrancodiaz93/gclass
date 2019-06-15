<?php
//create connection with server
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "gclass001";

$con = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if(!$con){
	die("Connection failed:" . mysqli_connect_error());
}
