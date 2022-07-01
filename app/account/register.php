<?php

    // Start the PHP_session
    session_start();

    // Variables
    $current_account_version = 2;
    $db_config = require('../config.php');

    // Get input
    $displayname = $_POST['username'];
    $username = strtolower($displayname);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Check if both passwords are the same
    if ($password != $password_repeat) {
        header("Location: register.html?c=21");
        exit;
    } else {

        // Check if email is a valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: register.html?c=01");
            exit;
        } else {

            // Check if displayname is valid
            // Only a-z | A-Z | 0-9 | _
            // Length: 4-12
            if (!preg_match("/^[a-zA-Z0-9_]{4,12}$/", $displayname)) {
                header("Location: register.html?c=02");
                exit;
            } else {

                // Check if password is valid
                // Length: 8-255
                // Contains at least one number, at least one uppercase, at least one lowercase letter and at least one special character
                if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,255}$/", $password)) {
                    header("Location: register.html?c=04");
                    exit;
                } else {

                    // Conect to database
                    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');
                    if (mysqli_connect_errno()) {
                        header("Location: register.html?c=98");
                        exit;
                    } else {

                        // Check if username is already taken
                        $stmt = $con->prepare("SELECT * FROM accounts WHERE username = ?");
                        $stmt->bind_param('s', $username);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            header("Location: register.html?c=11");
                            exit;
                        } else {

                            // Check if email is already taken
                            $stmt = $con->prepare("SELECT * FROM accounts WHERE email = ?");
                            $stmt->bind_param('s', $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 2) {
                                header("Location: register.html?c=12");
                                exit;
                            } else {
                                
                                // Create a salt
                                $salt = bin2hex(openssl_random_pseudo_bytes(32));
                                $pw_with_salt = $salt . $password;

                                // Hash the password
                                $hashed_pw = password_hash($pw_with_salt, PASSWORD_DEFAULT);

                                // Insert the user into the database
                                $stmt = $con->prepare("INSERT INTO accounts (username, displayname, email, password, salt, account_version) VALUES (?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param('sssssi', $username, $displayname, $email, $hashed_pw, $salt, $current_account_version);
                                $stmt->execute();

                                // Close the connection
                                $stmt->close();
                                $con->close();

                                // Redirect to login page
                                header("Location: login.html?c=13");
                            }
                        }
                    }
                }
            }
        }
    }
?>