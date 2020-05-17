<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $test = $_REQUEST['qrcode'];
    $sql = "UPDATE wa_web SET qrcode = '$test' where id = '1'";
        if ($conn->query($sql) === TRUE) {
            echo "Update record successfully " .$test;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        
} else {
    print_r('Methode Not Allowed');
}

       
?>