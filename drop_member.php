<?php require_once("functions/session.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?> 
<?php 
 
 
  // Process the form
  // validations
    
    $id= mysql_prep($_GET["user_id"]);
 
 
       
       //DELETE from Clients table where member_id = client_of
 
           $query= "DELETE FROM members WHERE id='{$id}'";
    $member_deleted = mysqli_query($connection, $query);
       
        if($member_deleted){
       
               $_SESSION["message"] = "Client Deleted.";
                redirect_to("home.php"); 
        }else{ echo "Delete Failed."; }
           
         
?> 
 