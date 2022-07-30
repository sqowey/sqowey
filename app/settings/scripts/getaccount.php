<?php 

    // Start the session, to get the data
    session_start();

    // Get the database login-credentials
    require("../../config.php");
    
    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the data from the database
    if ($stmt = $con->prepare('SELECT username, displayname, email, phone FROM accounts WHERE id = ?')) {

        // Bind the variables to the parameter
        $stmt->bind_param('s', $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $stmt->bind_result($username, $displayname, $email, $phone);

        // Avatar
        $avatar = '../../files/avatars/'.str_replace('-', '', $_SESSION['id']).".png";

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    
        // Return the data
        echo "DATA:".json_encode(array('username' => $username, 'displayname' => $displayname, 'email' => $email, 'phone' => $phone, 'avatar' => $avatar));

        // Store the data in the session
        $_SESSION['username'] = $username;
        $_SESSION['displayname'] = $displayname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['avatar'] = $avatar;

        // Close the connection
        $con->close();
    
        // Exit the script
        exit();
    }

?>