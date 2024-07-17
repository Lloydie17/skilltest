<?php

$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "library";


$conn = mysqli_connect($servername, $dbuser, $dbpass, $dbname);

if (!$conn) {

    echo "Cannot connect to the database!";
} 
	

