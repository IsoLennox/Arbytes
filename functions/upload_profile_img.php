<?php
$target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;


        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //FILE UPLOADED!
            //echo "The file ". $target_file. " has been uploaded.";

                  $user_id = $_SESSION["user_id"];
                $username = $_SESSION["username"];
            $yes=1;

                $query  = "INSERT INTO gallery (";
        $query .= "  user_id, author, path, pi";
        $query .= ") VALUES (";
        $query .= "  {$user_id},'{$username}', '{$target_file}', {$yes} ";
        $query .= ")";
        $result = mysqli_query($connection, $query);

             $img_query  = "UPDATE users SET profile_img ='{$target_file}' WHERE id = {$user_id} LIMIT 1";
        $image_set = mysqli_query($connection, $img_query);



        if ($result && $image_set && mysqli_affected_rows($connection) == 1) {
          // Success

    //        $_SESSION["profile_img"] = $target_file;
          $_SESSION["message"] = "Profile Image Updated!";






          redirect_to("profile.php?user_id={$_SESSION["user_id"]}");
        } else {
          // Failure
          $_SESSION["message"] = "Image uploaded. Filepath NOT written.";
        }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>