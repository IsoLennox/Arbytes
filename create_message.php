<?php include("inc/header.php"); ?> 
<?php 
$send_to=$_GET['user_id'];
$name=$_GET['name'];

if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("sent_to","content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
      //process form to find or create thread and message
       $sent_to = mysql_prep($_POST["sent_to"]);
      
      
      
      //get thread id that you are involved in
        $thread_query  = "SELECT * FROM thread WHERE user1={$_SESSION['user_id']} OR user2={$_SESSION['user_id']}"; 
        $thread_retrieved = mysqli_query($connection, $thread_query);
        $thread_retrieved_array = mysqli_fetch_assoc($thread_retrieved);
      
      if (!empty($thread_retrieved_array)) {
        //YOU HAVE THREADS
          
          //CHECK TO SEE IF THREAD IS WITH A NEW PERSON
   
    foreach($thread_retrieved as $check_interaction){
        //get user_id of person you are sending message to
        //loop through results, since all results are YOUR threads
         $interaction_query  = "SELECT * FROM thread WHERE user1={$sent_to} OR user2={$sent_to}"; 
        $interaction_retrieved = mysqli_query($connection, $interaction_query);
        $interaction_retrieved_array = mysqli_fetch_assoc($interaction_retrieved);
      
      if (!empty($interaction_retrieved_array)) {
          //YOU HAVE A THREAD WITH THIS PERSON, WRITE THE MESSAGE
          
          
                          //INSERT MESSAGE
          
            $content = mysql_prep($_POST["content"]);

            $dateTimeVariable = date("F j, Y \a\t g:ia");
            //create user
            $query  = "INSERT INTO messages (";
            $query .= "  thread_id, sent_by, sent_to, content, datetime, sent_to_keep, sent_from_keep";
            $query .= ") VALUES (";
            $query .= " {$interaction_retrieved_array['id']}, {$_SESSION['user_id']},{$sent_to}, '{$content}', '{$dateTimeVariable}',1,1";
            $query .= ") ";
            $new_message_created = mysqli_query($connection, $query);
 
            if ($new_message_created) {
                
                              
        //
        //  CREATE NOTIFICATION
        //
        //
                
 
      
        $notification_content = mysql_prep("<a href=\"read_message.php?thread_id=".$thread_retrieved_array['id']."&with_id=".$_SESSION['user_id']."\"><img src=\"img/icons/tiny-messages.png\" />  New message from ".$_SESSION['first_name']." ".$_SESSION['last_name']." </a> ");
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= " user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$sent_to},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ") ";
    $new_notification_created = mysqli_query($connection, $notifyquery);  
   
        //
        //
        //  END CREATE NOTIFICATION
        //
        //
             //SEND EMAIL!!
                
                //get user $sent_to email
                
        $email_query  = "SELECT * FROM members WHERE id={$sent_to}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $email_member= mysqli_fetch_assoc($email_found);
    $mail_to_name = $email_member['first_name'];
    $recipient = $email_member['email'];

$formcontent="\r\n \"".$content." \" \r\n Go to Arbytes to see full conversation: \r\n http://arbytes.isobellennox.com/messages.php";
$subject = "Arbytes: New Message!";
$mailheader = "New Message From ".$mail_to_name." on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
            
            

  $_SESSION["message"] = "Message Sent!!"; 
                redirect_to("messages.php");
        }else{
        echo "there was a problem sending the email";
        }
                 
                //END SEND EMAIL
            
//            
//            $_SESSION["message"] = "Message Sent!!"; 
//                redirect_to("messages.php");
            }//end inserrt message
           
      
      }else{
          
          //YOU DO NOT HAVE A THREAD WITH THIS PERSON
          
          
          
 
                    //CREATE THREAD
        $create_thread  = "INSERT INTO thread (";
        $create_thread .= "  user1, user2";
        $create_thread .= ") VALUES (";
        $create_thread .= "  {$sent_to},{$_SESSION['user_id']}";
        $create_thread .= ") ";
        $new_thread_created = mysqli_query($connection, $create_thread);
      if ($new_thread_created) {
          
      //THREAD CREATED
        //GET NEW THREAD ID
          
        $thread_query  = "SELECT * FROM thread WHERE user1={$sent_to} OR user2={$sent_to}"; 
        $thread_retrieved = mysqli_query($connection, $thread_query);
        $thread_retrieved_array = mysqli_fetch_assoc($thread_retrieved);
      
      if (!empty($thread_retrieved_array)) {
       //YOU HAVE A THREAD WITH THIS PERSON!
          
          //INSERT MESSAGE
          
            $content = mysql_prep($_POST["content"]);

            $dateTimeVariable = date("F j, Y \a\t g:ia");
            //create user
            $query  = "INSERT INTO messages (";
            $query .= "  thread_id, sent_by, sent_to, content, datetime, sent_to_keep, sent_from_keep";
            $query .= ") VALUES (";
            $query .= " {$thread_retrieved_array['id']}, {$_SESSION['user_id']},{$sent_to}, '{$content}', '{$dateTimeVariable}',1,1";
            $query .= ") ";
            $new_message_created = mysqli_query($connection, $query);





            if ($new_message_created) {
                
                
                
               
        //
        //  CREATE NOTIFICATION
        //
        //
                
 
      
        $notification_content = mysql_prep("<a href=\"read_message.php?thread_id=".$thread_retrieved_array['id']."&with_id=".$_SESSION['user_id']."\"><img src=\"img/icons/tiny-messages.png\" />  New message from ".$_SESSION['first_name']." ".$_SESSION['last_name']." </a> ");
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= " user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$sent_to},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ") ";
    $new_notification_created = mysqli_query($connection, $notifyquery);  
     
        //
        //
        //  END CREATE NOTIFICATION
        //
        //
                
                
                
                $_SESSION["message"] = "Message Sent!";
                redirect_to("messages.php");
            }
      }//end insert message
          
          
      }else{
        $_SESSION["message"] = "New thread failed.";
      }
   
            }//end check existence of thread with recipient
            
          }//end foreach
          
          
//insert message went here before check_interaction was created
          
          
          
          
      }elseif (empty($thread_retrieved_array)){
      
      //YOU DO NOT HAVE A THREAD WITH THIS PERSON
          
          //CREATE THREAD
             $create_thread  = "INSERT INTO thread (";
    $create_thread .= "  user1, user2";
    $create_thread .= ") VALUES (";
    $create_thread .= "  {$sent_to},{$_SESSION['user_id']}";
    $create_thread .= ") ";
    $new_thread_created = mysqli_query($connection, $create_thread);
      if ($new_thread_created) {
      
        //GET NEW THREAD ID
          //$_SESSION["message"] = "New thread created.";
          
        $thread_query  = "SELECT * FROM thread WHERE user1={$_SESSION['user_id']} OR user2={$_SESSION['user_id']}"; 
        $thread_retrieved = mysqli_query($connection, $thread_query);
        $thread_retrieved_array = mysqli_fetch_assoc($thread_retrieved);
      
      if (!empty($thread_retrieved_array)) {
       $_SESSION["message"] = "Not empty";
          
          //INSERT MESSAGE
          
            $content = mysql_prep($_POST["content"]);

            $dateTimeVariable = date("F j, Y \a\t g:ia");
            //create user
            $query  = "INSERT INTO messages (";
            $query .= "  thread_id, sent_by, sent_to, content, datetime, sent_to_keep, sent_from_keep";
            $query .= ") VALUES (";
            $query .= " {$thread_retrieved_array['id']}, {$_SESSION['user_id']},{$sent_to}, '{$content}', '{$dateTimeVariable}',1,1";
            $query .= ") ";
            $new_message_created = mysqli_query($connection, $query);





            if ($new_message_created) {
                              
      //
        //  CREATE NOTIFICATION +1 count
        //
        //
            $increment  = "SELECT * FROM msg_count WHERE user_id={$sent_to}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
            if(!empty($increment_found)){
                $increment_update  = "UPDATE msg_count SET count=count+1 WHERE user_id={$sent_to}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                }elseif(empty($increment_found)){
                
                //INSERT msg notifications row for user.
   $insert_count  = "INSERT INTO msg_count (user_id, count) VALUES (73, 0)";
    $new_counter_created = mysqli_query($connection, $insert_count);
        
      
      if (!empty($new_counter_created)) {
      
               //NOW find and update
                $increment_query  = "SELECT * FROM msg_count WHERE user_id={$sent_to}"; 
        $increment_found2 = mysqli_query($connection, $increment_query);  
                
                if($increment_found2){
 
     $increment_update  = "UPDATE msg_count SET count=count+1 WHERE user_id={$sent_to}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                    
                }else{
                    echo "there was a problem";
                }
                 
            }else{
            echo "could not update message count!";
            }
                    
                    
                 }//end if msg created, create notification count
   
        //
        //
        //  END CREATE NOTIFICATION
        //
        //
                
             //SEND EMAIL!!
                
                //get user $sent_to email
                
        $email_query  = "SELECT * FROM members WHERE id={$sent_to}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $email_member= mysqli_fetch_assoc($email_found);
    $mail_to_name = $email_member['first_name'];
    $recipient = $email_member['email'];

$formcontent="\r\n \"".$content." \" \r\n Go to Arbytes to see full conversation: \r\n http://arbytes.isobellennox.com/messages.php";
$subject = "Arbytes: New Message!";
$mailheader = "New Message From ".$mail_to_name." on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
            
            

  $_SESSION["message"] = "Message Sent!!"; 
                redirect_to("messages.php");
        }else{
        echo "there was a problem sending the email";
        }
                 
                //END SEND EMAIL
            
              
            }
      }//end insert message
          
          
      }else{
        $_SESSION["message"] = "New thread failed.";
      }
      
      }else{
        $_SESSION["message"] = "there was an error with the thread query";
      }

 
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Send Message To <?php echo $name ?></h2>
    <form action="create_message.php?user_id=<?php echo $send_to; ?>&name=<?php echo $name; ?>" method="post">
  
        <input type="hidden" name="sent_to" value="<?php echo $send_to; ?>" /> </p>
        
         <p>message: <br/>
    <textarea name="content" value="" rows="20" cols="100"></textarea></p>
         
      <input type="submit" name="submit" value="SEND" />
    </form>
    <br /> 
  </div>
</div> 
<?php include("inc/footer.php"); ?> 