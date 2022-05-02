<?php 
    // Get variables
    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pw_repeat = $_POST['new_pw_repeat'];


	// Start the session, to get the data
	session_start();

    // Get the database login-credentials
    require("../config.php");

    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

    // Prepare the SQL
    if ($stmt = $con->prepare('SELECT password FROM accounts WHERE username = ?')) {

        // Bind the parameters
        $stmt->bind_param('s', $_SESSION['name']);

        // Execute the statement
        $stmt->execute();

        // Bind the result
        $stmt->bind_result($db_pw);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();

        // Check if the old password is correct
        if (password_verify($old_pw, $db_pw)) {

            // Check if the new password is the same as the repeat
            if ($new_pw == $new_pw_repeat) {

                // Prepare the SQL
                if ($stmt = $con->prepare('UPDATE accounts SET password = ? WHERE username = ?')) {

                    // Bind the parameters
                    $stmt->bind_param('ss', password_hash($new_pw, PASSWORD_DEFAULT), $_SESSION['name']);

                    // Execute the statement
                    $stmt->execute();

                    // Close the statement
                    $stmt->close();

                    // Close the connection
                    $con->close();
                    
                    // Logout the user
                    session_destroy();

                    // Redirect to the login page
                    header('Location: ../../login.html');
                }
            }
        }
    }


?>