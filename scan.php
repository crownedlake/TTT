<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ttt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM `wordcount` WHERE 1;";
mysqli_query($conn,$sql);


$txtFile = file_get_contents('http://terriblytinytales.com/test.txt');
$txtFile = addslashes($txtFile);
$txtArr=preg_split("/[\s,]+/", $txtFile);
$wordCount=array_count_values($txtArr);
$txtArrUnq=array_unique($txtArr);
foreach ($txtArrUnq as  $value) {
	# code...
	// $value=addslashes($value);
	$count=$wordCount[$value];
	$sql = "INSERT INTO wordcount (word,count)
VALUES ('$value',$count);";
mysqli_query($conn,$sql);
}
echo $txtFile;

$conn->close();
?>
