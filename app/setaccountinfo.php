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
    header('Location: message.html?error=%22Bitte%20fuelle%20alle%20Felder%20aus%22');

    // Beende das script
    exit();
}

// check if values are empty.
if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['phone'])) {

    // One or more values are empty.
    header('Location: message.html?error=%22Bitte%20fuelle%20alle%20Felder%20aus%22');

    // Beende das script
    exit();
}

// if the mail is not real
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    // Log the error
    error_log("Error(104)-E-Mail:".$_POST['email'],0);

    // Show error
    header('Location: message.html?error=%22Das%20ist%20keine%20echte%20Mailadresse%22');

    // Beende das script
    exit();
}

// check for unusual characters in the username
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {

    // check username-length
    if(strlen($_POST['username']) > 18 || strlen($_POST['username']) < 4){

        // Log the error
        error_log("Error(105)-Nutzername:".$_POST['username'],0);    

        // show error
        header('Location: message.html?error=%22Der%20Benutzername%20muss%20zwischen%204%20und%2018%20lang%20sein%22');

        // Beende das script
        exit();
    }
}

// $sql = "UPDATE users SET username = '$username', password = '$password' WHERE id = '$id'"
$sql = "UPDATE `accounts` SET `username`='$new_username',`email`='$new_mail',`phone`='$new_phone' WHERE id = '$id'";

if ($con->query($sql) === TRUE) {
    // destroy the session
    session_destroy();
    // Incorrect password
    header('Location: message.html?error=%22Daten%20wurden%20veraendert%22');
    exit();
} else {
    echo "Error updating record: " . $con->error;
}

// close database connection
$con->close();
?> 