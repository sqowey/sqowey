<?php 

// DB config variables
require("../../app/config.php");
$DATABASE_NAME = 'sqowey_tmp';
$DATABASE_TABLE = 'pw_reset_auth';

// Get the data
$username = $_POST['username'];
$usermail = $_POST['mail'];

// Connect with the Credentials
$con = mysqli_connect($db_host, $db_user, $db_pass, $DATABASE_NAME);

// check if the connection was successfull
if (mysqli_connect_errno()) {

    // Log the error
    error_log("Error(101)-".mysqli_connect_error(),0);
    exit("Error(101)-".mysqli_connect_error());

    // Display an error.
    exit();
}

// Firstly check if there is already an password reset entry and if so, delete it
if($stmt = $con->prepare('DELETE FROM `'.$DATABASE_TABLE.'` WHERE username = ?')){

    // Bind the username
    $stmt->bind_param('s', $username);
    $stmt->execute();
    
    // close the statement
    $stmt->close();
}

// Create the six digit security code
$auth_code = strval(mt_rand(100000,999999));

// Create the invalidation timestamp
$auth_validation_time = date('Y-m-d H:i:s', strtotime('30 minutes'));

// Now insert the new set
if ($stmt = $con->prepare('INSERT INTO '.$DATABASE_TABLE.' (username, usermail, auth_code, valid_until) VALUES (?, ?, ?, ?)')) {

    // Bind parameters and execute
    $stmt->bind_param('ssss', $username, $usermail, $auth_code, $auth_validation_time);
    $stmt->execute();

    // close the statement
    $stmt->close();

    // close the database connection
    $con->close();

    // Save both username and usermail in session
    session_start();
    $_SESSION['pw_reset_username'] = $username;
    $_SESSION['pw_reset_usermail'] = $usermail;

    // Redirect to page two
    header('Location: ./second_step.html');

    // Exit the script
    exit();

} else {

    // Log the error
    exit("Error-".mysqli_error($con));
}

?>