<?php 

    // Get variables and convert them from strings to ints
    $privacy_messages = (int) $_POST['privacy_messages'];
    $privacy_friends = (int) $_POST['privacy_friends'];

    // Start the session, to get the data
    session_start();

    // Get the database login-credentials
    require("../../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'sqowey');
    
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if messages variable is set and only 0, 1 or 2
    if ($privacy_messages == 0 || $privacy_messages == 1 || $privacy_messages == 2) {
        
        // Check if friends variable is set and only 1 or 2 or 3
        if ($privacy_friends == 0 || $privacy_friends == 1 || $privacy_friends == 2) {

            // Insert the data into the database
            if($stmt = $con->prepare('UPDATE settings SET privacy_messages = ?, privacy_friends = ? WHERE user_id = ?')) {
                $stmt->bind_param('iii', $privacy_messages, $privacy_friends, $_SESSION['id']);
                $stmt->execute();
                $stmt->close();
            }
        }
    }


?>