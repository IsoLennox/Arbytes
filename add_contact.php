<?php require_once("functions/session.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?> 
<?php 

$contact_id=$_GET['contact_id'];

      //SEARCH DB FOR members EMAIL
      
    $query= "SELECT * FROM members WHERE id={$contact_id} lIMIT 1";
    $members_found = mysqli_query($connection, $query);
       
      
   if($members_found){
        
       $array= mysqli_fetch_assoc($members_found);
       
       if($contact_id!==$_SESSION['user_id']){
       
       //check contacts table to see if this instance exists or if Contact is you
       
           $query  = "SELECT * FROM contacts ";
           $query  .= "WHERE contact_id = {$contact_id} AND user_id ={$_SESSION['user_id']}";
    $contacts_exist = mysqli_query($connection, $query);
 
    if (!empty($contacts_exist)) {
 
 //INSERT INTO contacts
    
       
    $query  = "INSERT INTO contacts (";
    $query .= "  contact_id, user_id ";
    $query .= ") VALUES (";
    $query .= "  {$contact_id},{$_SESSION['user_id']}";
    $query .= ") ";
    $contacts_connected = mysqli_query($connection, $query);
 
    if ($contacts_connected) {
        
        
        //Success, send notification to new contact
        
        $dateTimeVariable = date("F j, Y \a\t g:ia");
         
        $notification_content = mysql_prep("<i class=\"fa fa-user-plus\"></i>  <a href=\"member_profile.php?user_id=".$_SESSION['user_id']."\">".$_SESSION['first_name']." ".$_SESSION['last_name']."</a> has added you a Contact!  "); 
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= "  user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$contact_id},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ")";
    $new_notification_created = mysqli_query($connection, $notifyquery);   
        
        
         
                
                //  CREATE NOTIFICATION +1 count
     
            $increment  = "SELECT * FROM notify_count WHERE user_id={$contact_id}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
            if(!empty($increment_found)){
                $increment_update  = "UPDATE notify_count SET count=count+1 WHERE user_id={$contact_id}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                }
   
        //  END CREATE NOTIFICATION count
      
        //end create notification
        
        
 
    // Success
      $_SESSION["message"] = $array['first_name']." ".$array['last_name']." Added As A Contact!";
     redirect_to("contacts.php");
    }else {
      // Failure
     $_SESSION["message"] = "Contact query failed.";
 redirect_to("contacts.php");
         
            }
        
        }else {
      // Failure
     $_SESSION["message"] = "Contact Already Exists.";
         redirect_to("contacts.php");
            }
       }else{
            $_SESSION["message"] = "Cannot Add Yourself As Contact."; 
           redirect_to("contacts.php");
           
       }
       
       
        }else{
            $_SESSION["message"] = "Nothing found."; 
        redirect_to("find_Contact.php"); 
            } ?>
           
<?php include("inc/footer.php"); ?> 