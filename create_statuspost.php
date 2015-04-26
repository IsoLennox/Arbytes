<?php include("inc/header.php"); ?> 
<?php 
if (isset($_POST['submit'])) {
     
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
    $private = mysql_prep($_POST["private"]);
 
    $dateTimeVariable = date("F j, Y   g:ia");
 
    $query  = "INSERT INTO status (";
    $query .= "  user_id,  datetime, title, is_private, content";
    $query .= ") VALUES (";
    $query .= " {$_SESSION['user_id']},'{$dateTimeVariable}','{$title}',{$private}, '{$content}'";
    $query .= ") ";
    $new_note_created = mysqli_query($connection, $query);
      
    
      
  

    if ($new_note_created) {
        
        
        
        
 
        
    // Success
      $_SESSION["message"] = "Status Updated!";
      redirect_to("status_feed.php"); 
    } else {
      // Failure
     $_SESSION["message"] = "Status Update Failed!";

    }
 
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Create status Post</h2>
    <form action="create_statuspost.php" method="post">
 
        <p>Title:
        <input type="text" name="title" value="" /> </p>
        
        
              
      <p>Privacy:  
        <input type="radio" name="private" value="0" checked />Public
        <input type="radio" name="private" value="1" />Only You
      </p>
        
        
         <p>Post Content: <br/>
    <textarea name="content" value="" rows="20" cols="100"></textarea></p>
         
      <input type="submit" name="submit" value="Create Note" />
    </form>
    <br /> 
  </div>
 
<?php include("inc/footer.php"); ?> 