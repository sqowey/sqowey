<?php 
    // Get variables
    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pw_repeat = $_POST['new_pw_repeat'];

	// Start the session, to get the data
	session_start();

    // Get the database login-credentials
    require("../../config.php");

    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

    // Get the salt and the password hash from the database
    $stmt = $con->prepare("SELECT salt, password, account_version FROM accounts WHERE id = ?");
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($salt, $password_hash, $account_version);
    $stmt->fetch();

    // Check if the account is already on version 2 or higher
    if($account_version < 2) {
        $password = $old_pw;
    } else {
        $password = $salt . $old_pw;
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if the old password is correct
    if(!password_verify($password, $password_hash)) {
        header("Location: ./settings.php?e=wrongoldpass");
        exit;
    } else {

        // Check if the new passwords are the same
        if($new_pw != $new_pw_repeat) {
            header("Location: ./settings.php?e=wrongnewpass");
            exit;
        } else {

            
            // Check if password is valid
            // Length: 8-255
            // Contains at least one number, at least one uppercase, at least one lowercase letter and at least one special character
            if(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z0-9])[0-9A-Za-z!@#$%^&*()_+\-=\[\]{};:\|,.<>\/?]{8,255}$/', $new_pw)) {
                header("Location: ./settings.php?e=invalidpass");
            } else {

                // Generate a salt
                $salt = bin2hex(openssl_random_pseudo_bytes(32));

                // Hash the new password
                $new_pw = $salt . $new_pw;
                $new_pw_hash = password_hash($new_pw, PASSWORD_DEFAULT);

                // Update the password
                $stmt = $con->prepare("UPDATE accounts SET password = ?, salt = ?, account_version = 2 WHERE id = ?");
                $stmt->bind_param('ssi', $new_pw_hash, $salt, $_SESSION['id']);
                $stmt->execute();

                // Log out of the account
                session_destroy();
                header('Location: ../../index.php');
                exit();
            }
        }
    }   
?>