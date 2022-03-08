<?php

    // Standart image variable
    $standart_imgs_folder = "../files/avatars/standart/";

    // Database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';

    // Default settings
    $DEFAULT_privacy = 0;
    $DEFAULT_language = 'de';
    $DEFAULT_status = 2;

    // Connect with the Credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());

        // Display an error.
        header('Location: register.html?message=Fehler mit<br>der Datenbank!');
        exit();
    }

    // check if the data was submitted
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {

        // Log the error
        error_log("Error(102)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

        // Could not get the data that should have been sent.
        header('Location: register.html?message=Bitte nutze<br>alle Felder!');

        // Beende das script
        exit();
    }

    // check if values are empty.
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

        // Log the error
        error_log("Error(103)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

        // One or more values are empty.
        header('Location: register.html?message=Bitte nutze<br>alle Felder!');

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
        header('Location: register.html?message=Das ist keine<br>echte Mailadresse');

        // Beende das script
        exit();
    }
    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {

        // check username-length
        if(strlen($_POST['username']) > 18 || strlen($_POST['username']) < 4){

            // Log the error
            error_log("Error(105)-Nutzername:".$_POST['username'],0);    

            // show error
            header('Location: register.html?message=Dein Benutzername muss<br>zwischen 4 und 18<br>Zeichen lang sein');

            // Beende das script
            exit();
        }
    }
    // if password doesn't have the right length
    if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 8) {

        // Log the error
        error_log("Error(107)-Passwort:".$_POST['username'],0);    

        // Show error
        header('Location: register.html?message=Das Passwort muss<br>den Anforderungen entsprechen');

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
            header('Location: register.html?message=Ein Nutzer mit diesem<br>Nutzernamen existiert schon');

            // Beende das script
            exit();

        } else {

            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, avatar) VALUES (?, ?, ?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.

                // Choose a random image 
                $random_img = $standart_imgs_folder.rand(1,8).".png";

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $random_img);
                $stmt->execute();


                // get the insert_id of the last inserted row
                $insert_id = $con->insert_id;

                // Prepare statement to create the entry in the settings table
                if($stmt = $con->prepare('INSERT INTO settings (user_id, privacy_statistics, privacy_enhance, privacy_ads, language, status) VALUES (?, ?, ?, ?, ?)')){

                    // Set the default settings
                    $stmt->bind_param('iiiis', $insert_id, $DEFAULT_privacy, $DEFAULT_privacy, $DEFAULT_privacy, $DEFAULT_language, $DEFAULT_status);
                    $stmt->execute();

                    // Log the success
                    error_log("Success(109)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

                    // Show success
                    header('Location: register.html?success=Erfolgreich registriert');

                    // Beende das script
                    exit();

                } else {

                    // Log the error
                    error_log("Error(110)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

                    // Show error
                    header('Location: register.html?message=Fehler mit<br>der Datenbank');

                    // Beende das script
                    exit();
                }
            } else {
                // Something is wrong with the sql statement, make sure accounts table exists with all 3 fields.

                // Log the error
                error_log("Error(109)-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".password_hash($_POST['password'], PASSWORD_DEFAULT),0);

                // Username exists already
                header('Location: register.html?message=Fehler mit<br>der Datenbank');
                exit();
            }
        }

        // close the dabase connection
        $stmt->close();
    } else {

        // The error log procedure for an error with the database connection
        error_log("Error()-Username:".$_POST['username']."|E-Mail:".$_POST['email']."|Passworthash:".$password,0);
        header('Location: register.html?message=Fehler mit<br>der Datenbank');
        exit();
    }

    // close the database connection
    $con->close();
?>