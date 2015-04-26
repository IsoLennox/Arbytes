<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

//FOLLOW OR UNFOLLOW BUTTON ACTION

$user_id =$_GET['user_id'];
$follow =$_GET['follow'];


 

if($follow==0){

    // User chose to unfollow, delete instance in following_status table
 
    $query = "DELETE FROM following_status WHERE you = {$_SESSION['user_id']} AND following = {$user_id}  ";
    
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Unfollowing!";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Failure
      $_SESSION["message"] = "Could not unfollow this user";
        
    }
    
}elseif($follow==1){
    
    // Create tabe instance of you following user_id
    // INSERT INTO `ilennox_arbytes`.`following_status` (`you`, `following`) VALUES ('5', '4');

 
        $query  = "INSERT INTO following_status (";
    $query .= " you, following";
    $query .= ") VALUES (";
    $query .= " {$_SESSION['user_id']}, {$user_id}";
    $query .= ") ";
    $result = mysqli_query($connection, $query);
    
    
    

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Following!";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Failure
      $_SESSION["message"] = "Could not follow this user";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }
}else{ 
    $_SESSION["message"] = "I did not understand your request.";
     header('Location: ' . $_SERVER['HTTP_REFERER']);
}
  
            ?>
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 