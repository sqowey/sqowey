<?php 

    // Get variables and convert them from strings to ints
    $theme = $_POST['theme'];

    echo $theme;
    
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

    // Insert the data into the database
    if($stmt = $con->prepare('UPDATE settings SET theme = ? WHERE user_id = ?')) {
        $stmt->bind_param('ii', $theme, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
    }

?>