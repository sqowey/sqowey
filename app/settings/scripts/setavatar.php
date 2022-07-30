<?php 
    // Start the PHP_session
    session_start();

    // get the user id
    $id = $_SESSION['id'];

    // The directory the avatars get uploaded to
    $upload_dir = "../../../files/avatars/";

    // Check if the server has received files
    if ($_SERVER ["REQUEST_METHOD"] === "POST") {

        // check if there are files
        if (isset($_FILES['avatar_upload'])) {

            // create empty error list
            $errors = [];

            // List of allowed extensions
            $extensions = ["bmp", "gif", "jpg", "jpeg", "png", "webp"];

            // Get the file name
            $file_name = $_FILES['avatar_upload']['name'];

            // Get the temp file
            $file_tmp = $_FILES['avatar_upload']['tmp_name'];

            // Get the file type
            $file_type = $_FILES['avatar_upload']['type'];

            // Get the file size
            $file_size = $_FILES['avatar_upload']['size'];

            // Get the file extension
            $explode_var = explode('.', $file_name);
            $file_ext = strtolower(end($explode_var));

            // create the new file 
            $file = $upload_dir . str_replace("-", "", $id) . ".png";
            $myfile = fopen($file, "w");
            fwrite($myfile, "");
            fclose($myfile);

            // check if file extension is allowed
            if (!in_array($file_ext, $extensions)) {

                // Create error record
                $errors[] = 'Dateityp nicht erlaubt: ' . $file_name . ' ' . $file_ext;
            }

            // check if file size is too big
            if ($file_size > 2097152) {

                // Create error record
                $errors[] = 'Datei zu groß: ' . $file_name . ' ' . $file_type;
            }
            
            // If there are no errors, move the file
            if (empty($errors)) {

                // Convert images to png
                switch ($file_ext) {
                    case 'bmp':
                        $image = imagecreatefrombmp($file_tmp);
                        break;
                    case 'jpg':
                    case 'jpeg':
                        $image = imagecreatefromjpeg($file_tmp);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($file_tmp);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($file_tmp);
                        break;
                    case 'webp':
                        $image = imagecreatefromwebp($file_tmp);
                        break;
                }
                imagepng($image, $file);
            }
            
            // If there are errors, print them
            if ($errors) print_r($errors);
        }
    }
?>