<?php

    // Config variables
    $current_account_version = 2;
    $avatar_path = "../files/avatars/";

    // Get all needed variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if any of the vars is empty or unset
    if(empty($username) || empty($email) || empty($password)) {
        header("Location: ../register.php?c=99");
        exit();
    } else {

        // Check if the mail is a real mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.html?c=01");
            exit();
        } else {

            // Check if the password is matching the requirements
            if($password == null || strlen($password) < 8 || strlen($password) > 255) {
                header("Location: ../register.html?c=04");
                exit();
            } else {

                // Check if username contains only letters, numbers and underscores
                if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                    header("Location: ../register.html?c=02");
                    exit();
                } else {

                    // Check if the username is between 4 and 12 characters long
                    if(strlen($username) < 4 || strlen($username) > 12){
                        header("Location: ../register.html?c=03");
                        exit();
                    } else {
                        
                        // Get all database variables
                        require('../config.php');

                        // Try to connect to the database
                        $con = mysqli_connect($db_host, $db_user, $db_pass, "accounts");
                        if(!$con) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Check if the username is already taken
                        if($stmt->prepare("SELECT username FROM accounts WHERE username = ?")) {
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $stmt->bind_result($username);
                            $stmt->fetch();
                            if($stmt->num_rows > 0) {
                                header("Location: ../register.html?c=11");
                                exit();
                            } else {

                                // Check if the email is already taken 3 times
                                if($stmt->prepare("SELECT email FROM accounts WHERE email = ?")){
                                    $stmt->bind_param("s", $email);
                                    $stmt->execute();
                                    $stmt->bind_result($email);
                                    $stmt->fetch();
                                    if($stmt->num_rows > 2){
                                        header("Location: ../register.html?c=12");
                                        exit();
                                    } else {

                                        // Generate a random salt
                                        $salt = bin2hex(openssl_random_pseudo_bytes(22));

                                        // Hash the password with the salt
                                        $password_and_hash = $password . $salt;

                                        // Hash the password with the salt
                                        $password_hash = password_hash($password_and_hash, PASSWORD_DEFAULT);

                                        // Insert the new user into the database
                                        if($stmt->prepare("INSERT INTO accounts (username, email, password, password_salt, account_version) VALUES (?, ?, ?, ?, ?)")) {
                                            $stmt->bind_param("ssssi", $username, $email, $password_hash, $salt, $current_account_version);
                                            $stmt->execute();

                                            // Set the avatar setting
                                            $account_id = $stmt->insert_id;
                                            if($stmt->prepare("UPDATE accounts SET avatar = ? WHERE id = ?")) {
                                                $stmt->bind_param("ii", $avatar_path.$account_id.".png", $account_id);
                                                $stmt->execute();
                                                header("Location: ../index.php?c=00");
                                                exit();

                                            }
                                        }
                                    }
                                }
                            }   
                        }    
                    }
                }
            }
        }
    }
?>