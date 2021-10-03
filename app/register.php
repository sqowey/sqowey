<?php
    // Database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';

    // Connect with the Credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());

        // Display an error.
        header('Location: message.html?error=%22Fehler%20mit%20der%20Datenbank%22');
        exit();
    }

    // check if the data was submitted
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {

        // Log the error
        error_log("Error(102)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

        // Could not get the data that should have been sent.
        header('Location: message.html?error=%22Bitte%20fuelle%20alle%20Felder%20aus%22');

        // Beende das script
        exit();
    }

    // check if values are empty.
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

        // Log the error
        error_log("Error(103)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

        // One or more values are empty.
        header('Location: message.html?error=%22Bitte%20fuelle%20alle%20Felder%20aus%22');

        // Beende das script
        exit();
    }

    // 
    // Validate all inputs
    // 

    // if the mail is not real
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        // Log the error
        error_log("Error(104)-E-Mail:".$_POST['email'],0);

        // Show error
        header('Location: message.html?error=%22Das%20ist%20keine%20echte%20Mailadresse%22');

        // Beende das script
        exit();
    }
    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {

        // check username-length
        if(strlen($_POST['username']) > 18 || strlen($_POST['username']) < 4){

            // Log the error
            error_log("Error(105)-Nutzername:".$_POST['username'],0);    

            // show error
            header('Location: message.html?error=%22Der%20Benutzername%20muss%20zwischen%204%20und%2018%20lang%20sein%22');

            // Beende das script
            exit();
        }
    }
    // if password doesn't have the right length
    if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 8) {

        // Log the error
        error_log("Error(107)-Passwort:".$_POST['username'],0);    

        // Show error
        header('Location: message.html?error=%22Das%20Passwort%20muss%20den%20Anforderungen%20entsprechen%22');

        // Beende das script
        exit();
    }

    // Check if the account with that username exists
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

        // Bind parameters
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        // Check if there is already an account with that username
        if ($stmt->num_rows > 0) {

            // Log the error
            error_log("Error(108)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);
    
            // Username exists already
            header('Location: message.html?error=%22Nutzername%20existiert%20schon%22');

            // Beende das script
            exit();

        } else {

            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                header('Location: message.html?message=%22Erfolgreich%20registriert%22&showReportButton=false');
                exit();
            } else {
                // Something is wrong with the sql statement, make sure accounts table exists with all 3 fields.

                // Log the error
                error_log("Error(109)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

                // Username exists already
                header('Location: message.html?message=%22Fehler%20mit%20der%20Datenbank%22');
                exit();
            }
        }
        $stmt->close();
    } else {
        error_log("Error()-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".$password,0);
        header('Location: message.html?error=%22Fehler%20mit%20der%20Datenbank%22');
        exit();
    }
    $con->close();
?>