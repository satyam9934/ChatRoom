<?php
$servername = "localhost";
$username = "root";
$password = "";
$database ="chatroom";

//creating data base connection

$conn = mysqli_connect($servername, $username, $password, $database);

//check connection

if(!$conn){
die ("Failed to conect". mysqli_connect_error());
}


?>