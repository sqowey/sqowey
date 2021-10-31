<?php
// Start the PHP_session
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accounts";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$new_mail = $_POST['email'];
$new_username = $_POST['username'];
$new_phone = $_POST['phone'];
$id = $_SESSION['id'];
 
// $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'"
$sql = "UPDATE `accounts` SET `username`='$new_username',`email`='$new_mail',`phone`='$new_phone' WHERE id = '$id'";

if ($con->query($sql) === TRUE) {
    // Incorrect password
    header('Location: message.html?error=%22Daten%20wurden%20veraendert%22');
    exit();
} else {
    echo "Error updating record: " . $con->error;
}

$con->close();
?> 