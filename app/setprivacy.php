<?php
    // Start the PHP_session
    session_start();

    // Database credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    $DATABASE_TABLE = 'settings';

    // Connect with the Credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // check if the connection was successfull
    if (mysqli_connect_errno()) {

        // Log the error
        error_log("Error(101)-".mysqli_connect_error(),0);
        exit("Error(101)-".mysqli_connect_error());

        // Display an error.
        exit();
    }

    // Get arg from post
    $arg = $_POST['privacy'];

    // Prepare the query
    if ($stmt = $con->prepare('SELECT privacy_statistics, privacy_enhance, privacy_ads FROM '.$DATABASE_TABLE.' WHERE user_id = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_SESSION['id']);
        $stmt->execute();

        // Store the result to check if the account exists in the database.
        $stmt->store_result();
        $stmt->bind_result($priv_stats, $priv_enhance, $priv_ads);
        $stmt->fetch();

        // Check if arg is all_switch, stats_switch, enhance_switch or ads_switch
        // Change the value of the database to the opposite of the current value
        // All values can only have true or false
        // If its all_switch, change all values to false and only if all are false, change all to true
        if ($arg == 'all_switch') {


            // Check if all are the true and change them to false
            // Else check if all are the false and change all to true
            // If not all are true or false, set all to true
            if ($priv_stats == '0' && $priv_enhance == '0' && $priv_ads == '0') {
                $priv_stats = '1';
                $priv_enhance = '1';
                $priv_ads = '1';
            } else {
                $priv_stats = '0';
                $priv_enhance = '0';
                $priv_ads = '0';
            }

        } else if ($arg == 'stats_switch') {


            // Change the value to the opposite
            if ($priv_stats == '1') {
                $priv_stats = '0';
            } else {
                $priv_stats = '1';
            }

        } else if ($arg == 'enhance_switch') {

            // Change the value to the opposite
            if ($priv_enhance == '1') {
                $priv_enhance = '0';
            } else {
                $priv_enhance = '1';
            }

        } else if ($arg == 'ads_switch') {

            // Change the value to the opposite
            if ($priv_ads == '1') {
                $priv_ads = '0';
            } else {
                $priv_ads = '1';
            }
            
        }

        // Close the statement
        $stmt->close();

        // Prepare the query
        // The query will update the values in the database
        if ($stmt = $con->prepare('UPDATE '.$DATABASE_TABLE.' SET privacy_statistics = ?, privacy_enhance = ?, privacy_ads = ? WHERE user_id = ?')) {

            // Bind parameters
            $stmt->bind_param('iiii', $priv_stats, $priv_enhance, $priv_ads, $_SESSION['id']);

            // Execute the statement
            $stmt->execute();
            
            // close the statement
            $stmt->close();

            // Go to index.html
            exit("success-reload");

        } else {

            // Log the error
            exit("Error-".mysqli_error($con));
        }

    } else {

        // Log the error
        exit("Error-".mysqli_error($con));
    }

    // close the database connection
    $con->close();

?>