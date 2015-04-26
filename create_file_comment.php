<?php include("inc/header.php");

$file_id=$_GET['file_id'];

 
     
  // Process the form
  
  // validations
  $required_fields = array("content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
    // Perform Create
 
    $content_raw = mysql_prep($_POST["content"]);
  $content= strip_tags($content_raw, '<p><a><img><br/><br><br />');
      
     $dateTimeVariable = date("F j, Y \a\t g:ia");
      //create user
    $query  = "INSERT INTO file_comments (";
    $query .= "  file_id, author, datetime, content";
    $query .= ") VALUES (";
    $query .= "  {$file_id},'{$_SESSION['user_id']}', '{$dateTimeVariable}', '{$content}'";
    $query .= ") ";
    $new_comment_created = mysqli_query($connection, $query);
 
    if ($new_comment_created) {
        
        
        
        //get comment ID 
        $comment_query  = "SELECT * FROM file_comments WHERE content={$content} ORDER BY id DESC LIMIT 1"; 
        $comment_retrieved = mysqli_query($connection, $comment_query);
        $comment_array= mysqli_fetch_assoc($comment_retrieved);
        $comment_id=$comment_array['id'];
        $comment_author=$comment_array['author'];
        
        
                //get file title 
        $file_query  = "SELECT * FROM files WHERE id={$file_id} LIMIT 1"; 
        $file_retrieved = mysqli_query($connection, $file_query);
        
        
        
        if($file_retrieved){
        $file_array= mysqli_fetch_assoc($file_retrieved);
        $file_title=$file_array['title'];
        $file_author=$file_array['author_id'];
        
        
        
          //Success, send notification to members: IF not you making a comment on your own file. 
        
        $notification_content = mysql_prep("<img src=\"img/icons/tiny-comments.png\" />  New comment on your file: '<a href=\"file_single.php?file_id=".$file_array['id']."\">$file_title</a>'!");
        
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= "  user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$file_author},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ") ";
    $new_notification_created = mysqli_query($connection, $notifyquery);  
        
        
                
                //  CREATE NOTIFICATION +1 count
     
            $increment  = "SELECT * FROM notify_count WHERE user_id={$file_author}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
            if(!empty($increment_found)){
                $increment_update  = "UPDATE notify_count SET count=count+1 WHERE user_id={$file_author}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                }
   
        //  END CREATE NOTIFICATION count
        
        
                        
 //SEND EMAIL 
                
        $email_query  = "SELECT * FROM members WHERE id={$file_author}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $author= mysqli_fetch_assoc($email_found);
    $name = $author['first_name'];
    $recipient = $author['email'];

$formcontent=" \r\n Go to Arbytes to view your file.\r\n";
$subject = "Arbytes: New Comment on your file";
$mailheader = "New Comment on a file you created on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
        
     
        }//end send email
    
        //end create notification
        
        
        
 
        
    // Success
      $_SESSION["message"] = "comment created!";
      redirect_to("file_single.php?file_id=$file_id"); 
    }//end if file retrieved
    } else {
      // Failure
     $_SESSION["message"] = "comment Failed!";
        redirect_to("files.php");

    }
 
    }else{
  echo "NO!";
  }//end confirm no errors in form 
 
include("inc/footer.php"); ?> 