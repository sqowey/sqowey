<?php 
    // Get mail and name from session
    session_start();
    $displayname = $_SESSION['pw_reset_displayname'];
    $username = $_SESSION['pw_reset_username'];
    $usermail = $_SESSION['pw_reset_usermail'];

    // Get inputs
    $input_auth_code = $_POST['code'];
    $input_new_password = $_POST['new_password'];
    $input_new_password_repeat = $_POST['new_password_repeat'];
        
    // DB config variables
    require("../../app/config.php");
    $TEMP_DATABASE_NAME = 'sqowey_tmp';
    $TEMP_DATABASE_TABLE = 'pw_reset_auth';
    $ACCOUNT_DATABASE_NAME = 'accounts';
    $ACCOUNT_DATABASE_TABLE = 'accounts';

    // Connect with the auth db
    $auth_db_con = mysqli_connect($db_host, $db_user, $db_pass, $TEMP_DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());

        // Display an error.
        exit();
    }

    // Get the auth code and validation timestamp from db
    if($auth_stmt = $auth_db_con->prepare('SELECT auth_code, valid_until FROM `'.$TEMP_DATABASE_TABLE.'` WHERE username = ?')){

        // Bind the username
        $auth_stmt->bind_param('s', $username);
        $auth_stmt->execute();

        // Store the result
        $auth_stmt->store_result(); 
        
        // Check if entry exists
        if ($auth_stmt->num_rows > 0) {
            $auth_stmt->bind_result($auth_code, $valid_until);
            $auth_stmt->fetch();

            // close the auth connection and open the account connection
            $auth_stmt->close();
            $auth_db_con->close();
            $account_db_con = mysqli_connect($db_host, $db_user, $db_pass, $ACCOUNT_DATABASE_NAME);

            // Check if validation Timestamp is in the future
            $date = new DateTime($valid_until);
            $now = new DateTime();
            if($date < $now) {
                header('Location: ./index.html?c=01');
                exit();
            }

            // Check if the auth_code matches the input
            if($input_auth_code != $auth_code){
                header('Location: ./index.html?c=03');
                exit();
            } 

            // Check if both input passwords match
            if($input_new_password != $input_new_password_repeat){
                header('Location: ./index.html?c=03');
                exit();
            }

            // Check if password matches password rules
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,255}$/", $input_new_password)) {
                header("Location: index.html?c=05");
                exit;
            }

            // Check if account exists with email
            if($account_stmt = $account_db_con->prepare('SELECT * FROM `accounts` WHERE username = ? AND email = ?')){
                // Bind the username
                $account_stmt->bind_param("ss", $username, $usermail);
                $account_stmt->execute();

                // Store the result
                $account_stmt->store_result(); 
                
                // Check if entry exists
                if ($account_stmt->num_rows == 0) {
                    header('Location: ./index.html?c=04');
                    exit();
                }
            } else {
                header('Location: ./second_step.html?c=99');
                exit();
            }

            // Create a salt
            $new_salt = bin2hex(openssl_random_pseudo_bytes(32));
            $new_pw_with_salt = $new_salt . $input_new_password;

            // Hash the password
            $new_pw_hashed = password_hash($new_pw_with_salt, PASSWORD_DEFAULT);

            // Insert the user into the database
            if($account_stmt = $account_db_con->prepare('UPDATE `accounts` SET `password` = ?, `salt` = ?, `account_version` = "2" WHERE username = ?')){
                // Bind the parameters
                $account_stmt->bind_param("sss", $new_pw_hashed, $new_salt, $username);
                $account_stmt->execute();

                // Close the connection
                $account_stmt->close();
                $account_db_con->close();

                // Destroy the session
                session_destroy();

                // Redirect to login
                header('Location: ../../app/account/');

            } else {
                header('Location: ./second_step.html?c=98');
                exit();
            }

        } else {

            // Redirect to the second page (with error message)
            header('Location: ./index.html?c=97');
            exit();
        }
    }

?>