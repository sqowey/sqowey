<!-- This is the File used to authenticate the user at login -->

<?php

    // Start the PHP_session
    session_start();
    
    // Get the database login-credentials
    require("../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

    // If there is an error whilst connecting, stop and display it
    if ( mysqli_connect_errno() ) {
        header('Location: login.html?c=01');
        exit();
    }

    // Look, if there are inputs in the fields
    if ( !isset($_POST['username'], $_POST['password']) ) {
        header('Location: login.html?c=02');
        exit();
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();

        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        // Check if Account exist
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();

            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($_POST['password'], $password)) {
                
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                
                // Redirect to the app
                header('Location: ../app.php');
            } else {

                // Incorrect password
                header('Location: login.html?c=03');
                exit();
            }
        } else {

            // Incorrect username
            header('Location: login.html?c=03');
            exit();
        }

        // Close the mysql connection
        $stmt->close();
    }
?>