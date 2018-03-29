
<?php
// This php file will read the the required number of entries and search the database
$q=$_GET["q"];
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
$sql="SELECT * FROM `wordcount` LIMIT $q;";
$result=mysqli_query($conn,$sql);
//returns all the entries
$result=mysqli_fetch_all($result,MYSQLI_NUM);
//conversion to a json object
echo json_encode($result);
$conn->close();
?>