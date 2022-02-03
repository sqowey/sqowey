<?php 


	// Start the session, to get the data
	session_start();

    // Variables with the login-credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    
    
    // Try to Connect with credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
    // Prepare the SQL
    if ($stmt = $con->prepare('SELECT status FROM settings WHERE user_id = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_SESSION['id']);
        $stmt->execute();

        // Store the result to check if the account exists in the database.
        $stmt->store_result();
        $stmt->bind_result($status);
        $stmt->fetch();

        // Save the status to a session variable
        $_SESSION['status'] = $status;

        if ($status == 0) {
            exit("online");
        } else if ($status == 1) {
            exit("away");
        } else if ($status == 2) {
            exit("disturb");
        }

        // Close the statement
        $stmt->close();

    }

    // Close the connection
    $con->close();

?>