<?php
// Start the PHP_session
session_start();

// Database login credentials
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

// check if the data was submitted
if (!isset($_POST['username'], $_POST['phone'], $_POST['email'])) {

    // Could not get the data that should have been sent.
    header('Location: settings.php?c=02');

    // Beende das script
    exit();
}

// check if values are empty.
if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['phone'])) {

    // One or more values are empty.
    header('Location: settings.php?c=02');

    // Beende das script
    exit();
}

// if the mail is not real
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    // Log the error
    error_log("Error(104)-E-Mail:".$_POST['email'],0);

    // Show error
    header('Location: settings.php?c=04');

    // Beende das script
    exit();
}

// check if the username is valid
if (!preg_match('/^[a-zA-Z0-9_]{3,18}$/', $_POST['username'])) {

    // Log the error
    error_log("Error(105)-Username:".$_POST['username'],0);

    // Show error
    header('Location: register.html?c=12');

    // Beende das script
    exit();
}

// $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'"
$sql = "UPDATE `accounts` SET `username`='$new_username',`email`='$new_mail',`phone`='$new_phone' WHERE id = '$id'";

if ($con->query($sql) === TRUE) {
    // destroy the session
    session_destroy();
    // Incorrect password
    header('Location: login.html?c=12');
    exit();
} else {
    echo "Error updating record: " . $con->error;
}

// close database connection
$con->close();
?> 