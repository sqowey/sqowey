<?php

// Start the PHP_session
session_start();

// Get the database login-credentials
require("config.php");

// Try to Connect with credentials
$con = mysqli_connect($db_host, $db_user, $db_user, 'accounts');

// check if the connection was successfull
if (mysqli_connect_errno()) {

    // Log the error
    error_log("Error(101)-".mysqli_connect_error(),0);
    exit("Error(101)-".mysqli_connect_error());

    // Display an error.
    exit();
}

// Check if the message is empty
if (empty($_POST['message'])) {

    // Log the error
    error_log("Error(102)-".mysqli_connect_error(),0);
    exit("Error(102)-".mysqli_connect_error());

    // Display an error.
    exit();
} else {
    if ($stmt = $con->prepare('INSERT INTO '.$DATABASE_TABLE.' (channel_type, reciever_id, sender_id, message_encrypted, message) VALUES (?, ?, ?, ?, ?)')) {

        // Because there are only direct messages yet, the channel type is 0
        $channel_type = 0;

        // Because there is no functional message-sending-function yet, the reciever id is always 4
        $reciever_id = 4;

        // Get the sender ID
        $sender_id = $_SESSION['id'];

        // Because there is no encrypted message function yet, $message_encrypted is always 1
        $message_encrypted = 0;

        // Get the message
        $message = $_POST['message'];
            

        $stmt->bind_param('biibs', $channel_type, $reciever_id, $sender_id, $message_encrypted, $message);
        $stmt->execute();

        // close the statement
        $stmt->close();

        // Go back to the app
        header('Location: app.php');

        // Exit the script
        exit();

    } else {

        // Log the error
        exit("Error-".mysqli_error($con));
    }
}
// close the database connection
$con->close();

?>