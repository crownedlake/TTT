<?php
// This php file will read the txt file and store 
// unique words with the total number of occurances in a database table
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
// clear the database table from entries of previous search
$sql = "Delete  FROM `wordcount` WHERE 1;";
mysqli_query($conn,$sql);

//read hosted file
$url='http://terriblytinytales.com/test.txt';
$txtFile = addslashes(file_get_contents($url));

//process the string received to output an array $txtArr 
$txtArr=preg_split("/[\s,]+/", $txtFile);

//outputs an associative array with word name matched with total number of occurances like [the]=>5
$wordCount=array_count_values($txtArr);

//outputs an array with only unique words
$txtArrUnq=array_unique($txtArr);

//for all the words in array $txtArrUnq
foreach ($txtArrUnq as  $value) {
	$count=$wordCount[$value];
	$sql = "INSERT INTO wordcount (word,count)
VALUES ('$value',$count);";
mysqli_query($conn,$sql);
}

//sort the table after doing all the entries
$sql="ALTER TABLE `wordcount` ORDER BY count DESC;";
mysqli_query($conn,$sql);

echo "Sucess";

$conn->close();
?>
