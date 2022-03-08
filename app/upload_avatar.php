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
$upload_dir = "../files/avatars/";

// Check if the server has received files
if ($_SERVER ["REQUEST_METHOD"] === "POST") {

    // check if there are files
	if (isset($_FILES['files'])) {

        // create empty error list
		$errors = [];

        // List of allowed extensions
		$extensions = ["jpg", "jpeg", "png", "svg"];

        // count how many files have been uploaded
		$all_files = count ($_FILES ["files"]["tmp_name"]);
		for ($i = 0; $i < $all_files; $i++) {

            // Get the file name
			$file_name = $_FILES['files']['name'][$i];

            // Get the temp file
			$file_tmp = $_FILES['files']['tmp_name'][$i];

            // Get the file type
			$file_type = $_FILES['files']['type'][$i];

            // Get the file size
			$file_size = $_FILES['files']['size'][$i];

            // Get the file extension
			$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

            // create the new file 
			$file = $upload_dir . $id . "." . $file_ext;

            // check if file extension is allowed
			if (!in_array($file_ext, $extensions)) {

                // Create error record
				$errors[] = 'Dateityp nicht erlaubt: ' . $file_name . ' ' . $file_type;
			}

            // check if file size is too big
			if ($file_size > 2097152) {

                // Create error record
				$errors[] = 'Datei zu groß: ' . $file_name . ' ' . $file_type;
			}
			
            // If there are no errors, move the file
			if (empty($errors)) {

                // move the file
				move_uploaded_file($file_tmp, $file);

                // create the new file path 
                $new_path = "../files/avatars/".$id . "." . $file_ext;

                // prepare the sql
                $sql = "UPDATE `accounts` SET `avatar`='$new_path' WHERE id = '$id'";

                // push the new path to the database
                if ($con->query($sql) === TRUE) {

                    // destroy the session
                    session_destroy();

                    // close database connection
                    $con->close();
                    
                    // redirect
                    header('Location: settings.php?message=Avatar wurde<br>erfolgreich geändert.');

                } else {

                    // Output the error
                    echo "Error updating record: " . $con->error;
                }
			}

            // Look if the file "." is in the upload_dir
            if (file_exists($upload_dir . ".")) {

                // delete the file
                unlink($upload_dir . ".");
            }
		}
		
        // If there are errors, print them
		if ($errors) print_r($errors);
	}
}
?>