<?php
$SkycorePostback = $_POST["XML"];
$SkycorePostbackObject = simplexml_load_string($SkycorePostback);
$PostbackTimeStamp = $SkycorePostbackObject->TIMESTAMP;

//Create Database
//---------------------------------------------------------
$con1 = mysqli_connect("localhost","root","");
// Check connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sqlDB="CREATE DATABASE POSTBACKDB";

if (mysqli_query($con1,$sqlDB)){
	echo "Database POSTBACKDB created successfully";
}
else{
	echo "Error creating database: " . mysqli_error($con1);
}
mysqli_close($con1);

//Create Table
//---------------------------------------------------------
$con2 = mysqli_connect("localhost","root","","POSTBACKDB");
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sqlTable = "CREATE TABLE TimeStamps(TimeStamp Longtext)";

if (mysqli_query($con2,$sqlTable)){
  echo "Table TimeStamps created successfully";
}
else {
	echo "Error creating table: " . mysqli_error($con2);
}
mysqli_close($con2);

//Insert Information Into Table
//---------------------------------------------------------
$con3 = mysqli_connect("localhost","root","","POSTBACKDB");
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con3, "INSERT INTO `TimeStamps`(`TimeStamp`) VALUES (\"$PostbackTimeStamp\")");

mysqli_close($con3);
?>
