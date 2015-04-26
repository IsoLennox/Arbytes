<?php include("inc/header.php"); ?> 
<?php 
if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("title","content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
    // Perform Create

    $title = mysql_prep($_POST["title"]);
    $content = mysql_prep($_POST["content"]);
 
    $dateTimeVariable = date("F j, Y \a\t g:ia");
      //create user
    $query  = "INSERT INTO notes (";
    $query .= "  group_id, author, datetime, title, content";
    $query .= ") VALUES (";
    $query .= "  {$_SESSION['group_id']},'{$_SESSION['user_id']}','{$dateTimeVariable}','{$title}', '{$content}'";
    $query .= ") ";
    $new_note_created = mysqli_query($connection, $query);
      
    
      
  

    if ($new_note_created) {
        
        //
        //
        //  CREATE NOTIFICATION
        //
        //
           //get note id
        $note_query  = "SELECT id FROM notes WHERE group_id={$_SESSION['group_id']} ORDER BY id DESC LIMIT 1"; 
        $note_retrieved = mysqli_query($connection, $note_query);
        $note_array= mysqli_fetch_assoc($note_retrieved);
        $note_id=$note_array['id'];
        $author_id=$note_array['author'];
 
        
         
        
         //Success, get each group member id
        $member_query  = "SELECT * FROM members WHERE group_id={$_SESSION['group_id']}"; 
        $member_retrieved = mysqli_query($connection, $member_query);
       
        
        
          //Success, send notification to each member
        
    foreach($member_retrieved as $member){
        
//         $member_array= mysqli_fetch_assoc($member_retrieved);
       
        
        $notification_content = mysql_prep("<img src=\"img/icons/tiny-comments.png\" />  New Post: '<a href=\"note_single.php?note_id=".$note_id."\">$title</a>' ");
        
     //create notification
    $notifyquery  = "INSERT INTO notifications (";
    $notifyquery .= " user_id, datetime, content";
    $notifyquery .= ") VALUES (";
    $notifyquery .= " {$member['id']},'{$dateTimeVariable}', '{$notification_content}'";
    $notifyquery .= ") ";
    $new_notification_created = mysqli_query($connection, $notifyquery);  
        
        
        
                
                //  CREATE NOTIFICATION +1 count
     
            $increment  = "SELECT * FROM notify_count WHERE user_id={$member['id']}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
            if(!empty($increment_found)){
                $increment_update  = "UPDATE notify_count SET count=count+1 WHERE user_id={$member['id']}"; 
        $increment_updated = mysqli_query($connection, $increment_update);
                    
                }
   
        //  END CREATE NOTIFICATION count
        
        
                              //SEND EMAIL!!
                
                //get user $sent_to email
                
 $email_query  = "SELECT * FROM members WHERE id={$member['id']}"; 
        $email_found = mysqli_query($connection, $email_query);  

        if($email_found){
            
    $member= mysqli_fetch_assoc($email_found);
            
            foreach($email_found as $members){
    $name = $members['first_name'];
    $recipient = $members['email'];

$formcontent=" \r\n Go to Arbytes to view new note.\r\n http://arbytes.isobellennox.com/notes.php";
$subject = "Arbytes: New Note";
$mailheader = "New Note was posted in your group on Arbytes! \r\n \"".$content."\"";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
            }
     
        }//end send email
        
        
        
        
    }
        //
        //
        //  END CREATE NOTIFICATION
        //
        //
        
 
        
    // Success
      $_SESSION["message"] = "Note created!";
      redirect_to("notes.php"); 
    } else {
      // Failure
     $_SESSION["message"] = "Note Failed!";

    }
 
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 
<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>290 Project: Arbytes</title>
     <!-- Arbyte is a play on words branched from the term "Arbeit" meaning 'task' or 'work' and "bytes" -->
     <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Create Note</h2>
    <form action="create_note.php" method="post">
 
        <p>Title:
        <input type="text" name="title" value="" /> </p>
        
         <p>Note: <br/>
    <textarea name="content" value="" rows="20" cols="100"></textarea></p>
         
      <input type="submit" name="submit" value="Create Note" />
    </form>
    <br /> 
  </div>
</div> 
<?php include("inc/footer.php"); ?> 