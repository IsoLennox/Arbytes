<?php include("inc/header.php"); ?> 
<?php 
if (isset($_POST['submit'])) {
    
    $group_id=$_GET['group_id'];
    $groupname=$_GET['group_name'];
     
  // Process the form
  
  // validations
  $required_fields = array("title","content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
    // Perform Create

    $title_raw = mysql_prep($_POST["title"]);
       $title= strip_tags($title_raw, '<p><a><img><br/><br><br />');
    $content_raw = mysql_prep($_POST["content"]);
       $content= strip_tags($content_raw, '<p><a><img><br/><br><br />');
 
    $dateTimeVariable = date("F j, Y \a\t g:ia");
      //create user
    $query  = "INSERT INTO posts (";
    $query .= "  group_id, author, datetime, title, content";
    $query .= ") VALUES (";
    $query .= "  {$group_id},'{$_SESSION['user_id']}','{$dateTimeVariable}','{$title}', '{$content}'";
    $query .= ") ";
    $new_post_created = mysqli_query($connection, $query);
      
    
      
  

    if ($new_post_created) {
        
        //
        //
        //  CREATE NOTIFICATION
        //
        //
           //get post id
        $post_query  = "SELECT id FROM posts WHERE group_id={$_SESSION['group_id']} ORDER BY id DESC LIMIT 1"; 
        $post_retrieved = mysqli_query($connection, $post_query);
        $post_array= mysqli_fetch_assoc($post_retrieved);
        $post_id=$post_array['id'];
        $author_id=$post_array['author'];
 
        
         
        
         //Success, get each group member id
        $member_query  = "SELECT * FROM members WHERE group_id={$_SESSION['group_id']}"; 
        $member_retrieved = mysqli_query($connection, $member_query);
       
        
        
          //Success, send notification to each member
        
    foreach($member_retrieved as $member){
        
//         $member_array= mysqli_fetch_assoc($member_retrieved);
       
        
        $notification_content = mysql_prep("<i class=\"fa fa-pencil-square-o\"></i> New Post: '<a href=\"post_single.php?post_id=".$post_id."\">$title</a>' ");
        
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

$formcontent=" \r\n Go to Arbytes to view new post.\r\n http://arbytes.isobellennox.com/posts.php";
$subject = "Arbytes: New post";
$mailheader = "New post was posted in your group on Arbytes! \r\n \"".$content."\"";
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
      $_SESSION["message"] = "post created!";
      redirect_to("posts.php?group_id=$group_id&group_name=$groupname"); 
    } else {
      // Failure
     $_SESSION["message"] = "post Failed!";

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
    
    <h2>Create post</h2>
    <form action="create_post.php" method="post">
 
        <p>Title:
        <input type="text" name="title" value="" /> </p>
        
         <p>post: <br/>
    <textarea name="content" value="" rows="20" cols="100"></textarea></p>
         
      <input type="submit" name="submit" value="Create post" />
    </form>
    <br /> 
  </div>
</div> 
<?php include("inc/footer.php"); ?> 