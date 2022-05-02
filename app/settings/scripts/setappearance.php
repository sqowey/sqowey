<?php 

    // Get variables and convert them from strings to ints
    $theme = $_POST['theme'];

    echo $theme;
    
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

    // Insert the data into the database
    if($stmt = $con->prepare('UPDATE settings SET theme = ? WHERE user_id = ?')) {
        $stmt->bind_param('ii', $theme, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
    }

?>