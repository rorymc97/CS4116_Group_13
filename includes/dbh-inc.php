<?php //dbase001.php

$servername = "sql312.epizy.com";
$username = "epiz_28009504";
$password = "AtnzzYRZ7tnyAW";
$dbname = "epiz_28009504_CS4116";
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}