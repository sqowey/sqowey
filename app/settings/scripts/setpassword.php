<?php 
    // Get variables
    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pw_repeat = $_POST['new_pw_repeat'];

	// Start the session, to get the data
	session_start();

    // Get the database login-credentials
    require("../../config.php");

    // Try to Connect with credentials
    $con = mysqli_connect($db_host, $db_user, $db_pass, 'accounts');

?>