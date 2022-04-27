<?php 
    // Start the PHP_session
    session_start();

    // Database login credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "accounts";

    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($con->connect_error) {

        // exit the script and show error
        die("Connection failed: " . $con->connect_error);
    }

    // get the user id
    $id = $_SESSION['id'];

    // The directory the avatars get uploaded to
    $upload_dir = "../../files/avatars/";

    // get the avatar image
    $avatar = $_POST['avatar'];

    // Generate a link to the avatar
    $avatar_link = "../../files/avatars/" . $id . ".png";

    // Update the avatar link in the database
    if ($stmt = $con->prepare("UPDATE accounts SET avatar = ? WHERE id = ?")) {

        // Bind the parameters
        $stmt->bind_param("si", $avatar_link, $id);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }
?>