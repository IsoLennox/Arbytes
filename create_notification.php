<?php include("inc/header.php");  
 
//FOR REFERENCE ONLY, NOT AN ACTUAL LINKED PAGE

if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("content");
  validate_presences($required_fields);
  
    $content = mysql_prep($_POST["content"]);

    
  if (empty($errors) ) {
    // Perform Create
 
    
      //create notification
    $query  = "INSERT INTO notifications (";
    $query .= "  group_id, user_id, datetime, content";
    $query .= ") VALUES (";
    $query .= "  {$_SESSION['group_id']},'{$_SESSION['user_id']}',current_timestamp, '{$content}'";
    $query .= ") ";
    $new_notification_created = mysqli_query($connection, $query);
      
 
    if ($new_notification_created) {
 
        
        
              // Success
     $_SESSION["message"] = "Notification Created!";
        redirect_to("create_notification.php");
        
        
 
    } else {
      // Failure
     $_SESSION["message"] = "notification Failed!";
        redirect_to("create_notification.php");
    }//end if notification created
 
 
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Create notification</h2>
    <form action="create_notification.php" method="post">
  
        
         <p>Content: <br/>
    <textarea name="content" value="NOTIFICATION!" rows="20" cols="100"></textarea></p>
  
 
     
      <input type="submit" name="submit" value="Create notification" />
    </form>
    <br /> 
  </div>
 <?php
include("inc/footer.php");
?> 