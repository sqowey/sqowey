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
    if ($stmt = $con->prepare('SELECT privacy_messages, privacy_friends FROM settings WHERE user_id = ?')) {

        // Bind the variables to the parameter
        $stmt->bind_param('i', $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $stmt->bind_result($privacy_messages, $privacy_friends);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    
        // Return the data
        echo "DATA:".json_encode(array('privacy_messages' => $privacy_messages, 'privacy_friends' => $privacy_friends));

        // Close the connection
        $con->close();
    
        // Exit the script
        exit();
    }

?>