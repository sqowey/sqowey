<?php 

    // Start the session, to get the data
    session_start();

    // Variables with the login-credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    
    // Create connection
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the data from the database
    if ($stmt = $con->prepare('SELECT username, email, phone, avatar FROM accounts WHERE id = ?')) {

        // Bind the variables to the parameter
        $stmt->bind_param('i', $_SESSION['id']);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $stmt->bind_result($username, $email, $phone, $avatar);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    
        // Return the data
        echo "DATA:".json_encode(array('username' => $username, 'email' => $email, 'phone' => $phone, 'avatar' => $avatar));

        // Store the data in the session
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['avatar'] = $avatar;

        // Close the connection
        $con->close();
    
        // Exit the script
        exit();
    }

?>