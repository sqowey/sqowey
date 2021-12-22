<?php
    // Start sessions
    session_start();

    // Set the language
    $_SESSION['language'] = $_POST['language'];

    // Database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    $DATABASE_TABLE = 'settings';

    // Connect with the Credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());

        // Display an error.
        exit();
    }

    // Prepare the SQL statement
    if ($stmt = $con->prepare('INSERT INTO '.$DATABASE_TABLE.' (language) VALUES (?)')) {

        // Bind parameters
        $stmt->bind_param('s', $_POST['language']);

        // Execute the statement
        $stmt->execute();

        exit();

        // close the statement
        $stmt->close();

    } else {

        // Log the error
        exit("Error-".mysqli_error($con));
    }

    // close the database connection
    $con->close();

?>