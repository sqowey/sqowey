<?php 

    // Get variables and convert them from strings to ints
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Start the session, to get the data
    session_start();

    // Get the database login-credentials
    require("../../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check phone number (can only contain numbers and +)
    if (!preg_match("/^[0-9+]+$/", $phone)) {
        echo "Phone number can only contain numbers and +";
        exit();
    } else {

        // Check if username has changed
        if ($username != $_SESSION['username']) {

            // Check if username is already taken
            if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {

                // Bind the variables to the parameter
                $stmt->bind_param('s', $username);

                // Execute the statement
                $stmt->execute();

                // Get the result
                $stmt->bind_result($id);

                // Fetch the result
                $stmt->fetch();

                // Close the statement
                $stmt->close();

                // Check if the username is already taken
                if ($id != null) {
                    echo "Username is already taken";
                    exit();
                }
            }
        }

        // Check if email has changed
        if ($email != $_SESSION['email']) {

            // Check if email is already taken
            if ($stmt = $con->prepare('SELECT id FROM accounts WHERE email = ?')) {
    
                    // Bind the variables to the parameter
                    $stmt->bind_param('s', $email);
    
                    // Execute the statement
                    $stmt->execute();
    
                    // Get the result
                    $stmt->bind_result($id);
    
                    // Fetch the result
                    $stmt->fetch();
    
                    // Close the statement
                    $stmt->close();
    
                    // Check if the email is already taken
                    if ($id != null) {
                        echo "Email is already taken";
                        exit();
                    }
            }
        }

        // Check if phone has changed
        if ($phone != $_SESSION['phone']) {

            // Check if phone is already taken
            if ($stmt = $con->prepare('SELECT id FROM accounts WHERE phone = ?')) {
    
                    // Bind the variables to the parameter
                    $stmt->bind_param('s', $phone);
    
                    // Execute the statement
                    $stmt->execute();
    
                    // Get the result
                    $stmt->bind_result($id);
    
                    // Fetch the result
                    $stmt->fetch();
    
                    // Close the statement
                    $stmt->close();
    
                    // Check if the phone is already taken
                    if ($id != null) {
                        echo "Phone is already taken";
                        exit();
                    }
            }
        }

        // Insert the data into the database
        if($stmt = $con->prepare('UPDATE accounts SET username = ?, email = ?, phone = ? WHERE id = ?')) {
            $stmt->bind_param('sssi', $username, $email, $phone, $_SESSION['id']);
            $stmt->execute();
            $stmt->close();

            // Reload the settings page
            header('Location: ../settings.html');
            echo "<script>resetFormAccounts();window.location.href = 'settings.php';</script>";
        }
    
    
    }

?>