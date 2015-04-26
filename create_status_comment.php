<?php include("inc/header.php");

$post_id=$_GET['post_id'];

 
     
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
    $query  = "INSERT INTO status_comments (";
    $query .= "  post_id, author, datetime, content";
    $query .= ") VALUES (";
    $query .= "  {$post_id},'{$_SESSION['user_id']}', '{$dateTimeVariable}', '{$content}'";
    $query .= ") ";
    $new_comment_created = mysqli_query($connection, $query);
 
    if ($new_comment_created) {
        
        
        
        //get comment ID 
        $comment_query  = "SELECT * FROM status_comments WHERE content={$content} ORDER BY id DESC LIMIT 1"; 
        $comment_retrieved = mysqli_query($connection, $comment_query);
        $comment_array= mysqli_fetch_assoc($comment_retrieved);
        $comment_id=$comment_array['id'];
        $comment_author=$comment_array['author'];
        
        
                //get post title 
        $post_query  = "SELECT * FROM status WHERE id={$post_id} LIMIT 1"; 
        $post_retrieved = mysqli_query($connection, $post_query);
        $post_array= mysqli_fetch_assoc($post_retrieved);
        $post_title=$post_array['title'];
        $post_author=$post_array['author'];
        
        
        
          //Success, send notification to members: IF not you making a comment on your own post. 
        
        $notification_content = mysql_prep("<i class=\"fa fa-comments\"></i>  New comment on your post: '<a href=\"status_single.php?post_id=".$post_id."\">$post_title</a>'!");
        
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= "  user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$post_author},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ") ";
    $new_notification_created = mysqli_query($connection, $notifyquery);  
        
        
                
                //  CREATE NOTIFICATION +1 count
     
            $increment  = "SELECT * FROM notify_count WHERE user_id={$post_author}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
            if(!empty($increment_found)){
                $increment_update  = "UPDATE notify_count SET count=count+1 WHERE user_id={$post_author}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                }
   
        //  END CREATE NOTIFICATION count
        
        
                        
 //SEND EMAIL 
                
        $email_query  = "SELECT * FROM members WHERE id={$post_author}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $author= mysqli_fetch_assoc($email_found);
    $name = $author['first_name'];
    $recipient = $author['email'];

$formcontent=" \r\n Go to Arbytes to view your post.\r\n";
$subject = "Arbytes: New Comment on your post";
$mailheader = "New Comment on a post you created on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
        
     
        }//end send email
    
        //end create notification
        
        
        
 
        
    // Success
      $_SESSION["message"] = "comment created!";
      redirect_to("status_single.php?post_id=$post_id"); 
    } else {
      // Failure
     $_SESSION["message"] = "comment Failed!";

    }
 
    }//end confirm no errors in form 
 
include("inc/footer.php"); ?> 