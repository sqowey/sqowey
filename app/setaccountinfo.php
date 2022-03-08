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
    header('Location: settings.php?message=Bitte nutze<br>alle Felder!');

    // Beende das script
    exit();
}

// check if values are empty.
if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['phone'])) {

    // One or more values are empty.
    header('Location: settings.php?message=Bitte nutze<br>alle Felder!');

    // Beende das script
    exit();
}

// if the mail is not real
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    // Log the error
    error_log("Error(104)-E-Mail:".$_POST['email'],0);

    // Show error
    header('Location: settings.php?message=Das ist keine<br>echte Mailadresse');

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
        header('Location: settings.php?message=Dein Benutzername muss<br>zwischen 4 und 18<br>Zeichen lang sein');

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
    header('Location: settings.php?message=Deine Daten<br>wurden veraendert');
    exit();
} else {
    echo "Error updating record: " . $con->error;
}

// close database connection
$con->close();
?> 