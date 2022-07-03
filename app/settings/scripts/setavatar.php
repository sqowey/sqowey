<?php 
    // Start the PHP_session
    session_start();
    
    // get the user id
    $id = $_SESSION['id'];

    // The directory the avatars get uploaded to
    $upload_dir = "../../../files/avatars/";
    $upload_path = $upload_dir.$id.".".strtolower(pathinfo($_FILES["avatar_upload"]["name"],PATHINFO_EXTENSION));
    $imageFileType = strtolower(pathinfo($upload_path,PATHINFO_EXTENSION));
    
    if(isset($_FILES["avatar_upload"])) {
        $imagesize = getimagesize($_FILES["avatar_upload"]["tmp_name"]);

        if ($imagesize == false) {
            header("Location: ../../settings/settings.php?e=filetype");
        } else {

            // Check file size
            if ($_FILES["avatar_upload"]["size"] > 800000) {
                header("Location: ../../settings/settings.php?e=filesize");
            } else {

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    header("Location: ../../settings/settings.php?e=filetype");
                } else {

                    if (move_uploaded_file($_FILES["avatar_upload"]["tmp_name"], $upload_path)) {
                        header("Location: ../../settings/settings.php?m=success");
                    } else {
                        exit("Error".$upload_path);
                        header("Location: ../../settings/settings.php?e=couldntupload");
                    }
                }
            }
        }
    
    } else {

        header("Location: ../../settings/settings.php?m=error");
    }

?>