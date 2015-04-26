<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$file_id =$_GET['filepath'];


    $query  = "UPDATE profile_img SET ";
    $query .= "current = 0 ";
    $query .= "WHERE user_id = {$_SESSION['user_id']} ";
    $result = mysqli_query($connection, $query);


    $update_query  = "UPDATE profile_img SET ";
    $update_query .= "current = 1 ";
    $update_query .= "WHERE filepath = '{$file_id}' ";
    $update_query .= "LIMIT 1";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "file updated.";
      redirect_to("view_image.php?filepath={$file_id}");
    } else {
      // Failure
      $_SESSION["message"] = "file update failed.";
        redirect_to("view_image.php?filepath={$file_id}");
    }
        
        










?> 
</div> 
<?php include("inc/footer.php"); ?> 