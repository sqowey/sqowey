<?php 

    // Start the session, to get the data
    session_start();

    // Get the database login-credentials
    require("../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_user, 'accounts');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the data from the database
    if ($stmt = $con->prepare('SELECT language FROM settings WHERE user_id = ?')) {

        // Bind the variables to the parameter
        $stmt->bind_param('i', $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $stmt->bind_result($lang);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    
        // Return the data
        echo $lang;

        // Close the connection
        $con->close();
    
        // Exit the script
        exit();
    }

?>