<?php
	// Start the session, to get the data
	session_start();

	// If the user is logged in redirect to the app page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        // Redirect to app
        header('Location: ./app.php');

        // Exit script
        exit();
        
    } else {

        // Redirect to login
        header('Location: ./account/index.php');

        // Exit script
        exit();
    }
?>