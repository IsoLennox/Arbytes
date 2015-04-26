<?php include("inc/header.php"); ?> 
<?php 
 $thread_id=$_GET['thread_id'];
  // validations
  $required_fields = array("sent_to","content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
      //process form to find or create thread and message
       $sent_to = mysql_prep($_POST["sent_to"]);
      
      
      
      //get thread id that you are involved in
        $thread_query  = "SELECT * FROM thread WHERE id={$thread_id}"; 
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
            $query .= " {$thread_id}, {$_SESSION['user_id']},{$sent_to}, '{$content}', '{$dateTimeVariable}',1,1";
            $query .= ") ";
            $new_message_created = mysqli_query($connection, $query);
 
            if ($new_message_created) {
                
                              
        //
        //  CREATE NOTIFICATION
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

$formcontent=" \r\n Go to Arbytes to see full conversation: \r\n http://arbytes.isobellennox.com/read_message.php?thread_id=".$thread_id."&with_id=".$_SESSION['user_id'];
$subject = "Arbytes: New Message!";
$mailheader = "New Message from ".$_SESSION['first_name']." on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
            
            

   
          redirect_to("read_message.php?thread_id=".$thread_id."&with_id=".$sent_to."");
        }else{
        echo "there was a problem sending the email";
        }
                
                
             
            }//end inserrt message
           
      
      }else{
          
          //YOU DO NOT HAVE A THREAD WITH THIS PERSON
          
           $_SESSION["message"] = "This thread does not exist with this user, apparently.";
           
   
            }//end check existence of thread with recipient
            
          }//end foreach
    
      }elseif (empty($thread_retrieved_array)){
      
      //YOU DO NOT HAVE A THREAD WITH THIS PERSON
          
          
        $_SESSION["message"] = "This thread does not exist, apparently.";
      }

 
    }//end confirm no errors in form
?>  