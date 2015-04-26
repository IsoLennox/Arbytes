<?php
//if(isset($_GET['$title'])){
//    $title=$_GET['$title'];
//}else{
//    $title="Untitled.";
//}
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
 
}
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, FILE NAME already exists.";
    $_SESSION["message"] = "Sorry, FILE NAME already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    //echo "Sorry, your file is too large.";
    $_SESSION["message"] = "Sorry, your file is too large. 5000kb is the max file size.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "css" ) { 
    $_SESSION["message"] = "Sorry, only CSS files are allowed.";
    $uploadOk = 0;
}
 


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION["message"] .= "    Your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //FILE ACCEPTED! 
       
            $user_id = $_SESSION["user_id"];
            $company_id = $_SESSION["company_id"];
       $dateTimeVariable = date("F j, Y \a\t g:ia");
            $query  = "INSERT INTO themes (";
    $query .= "  title, filepath, author_id";
    $query .= ") VALUES (";
    $query .= "  '{$title}', '{$target_file}', {$_SESSION['user_id']}";
    $query .= ")";
    $result = mysqli_query($connection, $query);
         

    if ($result && mysqli_affected_rows($connection) == 1) {
      
        
        
      $_SESSION["message"] = "File Upload Successful!";      
        
      redirect_to("upload_theme.php");
   // } //END IF RESULT SUCCESS
    }else {
      // Failure
      $_SESSION["message"] = "File uploaded. Filepath NOT written.";
    }
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    

?>