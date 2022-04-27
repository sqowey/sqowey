<?php 

    // Get all values
    $time_until_deletion = $_POST['time_until_deletion'];
    // Get the current time
    $current_time = time();
    // Add the time until deletion to the current time (its in days)
    $time_until_deletion = $current_time + ($time_until_deletion * 24 * 60 * 60);
    // Make a timestamp out of the time until deletion
    $time_until_deletion = date('Y-m-d H:i:s', $time_until_deletion);

	// Start the session, to get the data
	session_start();

    // Variables with the login-credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'accounts';
    
    
    // Try to Connect with credentials
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // Prepare the SQL
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {

        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_SESSION['name']);
        $stmt->execute();

        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        // Check if Account exist
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();

            // Check if the password is correct
            if (password_verify($_POST['password'], $password)) {
                
                // Add the deletion time to the database
                if ($stmt = $con->prepare('UPDATE accounts SET delete_until = ? WHERE id = ?')) {
                    $stmt->bind_param('si', $time_until_deletion, $id);
                    $stmt->execute();
                }

                // Destroy the session
                session_destroy();

                // Redirect to the index-page
                header('Location: ./success/index.html?t='.$time_until_deletion);

                // Exit the script
                exit;

            } else {

                // Password is wrong
                header('Location: ./index.php?e=wp');
            }
            
        }
    }

    // Close the connection
    $con->close();

?>