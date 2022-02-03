<?php 

    // Start sessions
    session_start();

    // The database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';

    // Get status from post
    $status = $_POST['status'];

    // Connect with the Credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());
    }

    if($status == "online"){
        $status_id = 0;
    } else if ($status == "away"){
        $status_id = 1;
    } else if ($status == "disturb"){
        $status_id = 2;
    } else {
        exit("Error(102) - Status ist nicht definiert | Status: ".$status);
    }

    // Insert the data into the database
    if($stmt = $con->prepare('UPDATE settings SET status = ? WHERE user_id = ?')) {

        // Bind the variables
        $stmt->bind_param('ii', $status_id, $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Close with success
        exit("SUCCESS - ".$status_id." | Status: ".$status);
    } else {
        // Log the error
        error_log("Error(102)-".mysqli_error($con),0);
        exit("Error(102)-".mysqli_error($con));
    }

    // Close the connection
    $con->close();

    exit("Error(103)-Something went wrong");
?>