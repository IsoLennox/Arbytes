<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$post_id =$_GET['post_id'];


 

$query = "SELECT * FROM posts WHERE id = {$post_id}";
$current_post = mysqli_query($connection, $query);


//for each post_id, get data
$title ="";
$post_content ="";
$post = mysqli_fetch_assoc($current_post);
$title =$post["title"];
$post_content= $post["content"];


if (isset($_POST['submit'])) {
     
    
  // Process the form
  
   
  $title = mysql_prep($_POST["title"]);
  $content = mysql_prep($_POST["content"]);

  // validations
  $required_fields = array("title", "content");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("title" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $query  = "UPDATE posts SET ";
    $query .= "title = '{$title}', ";
    $query .= "content = '{$content}' ";
    $query .= "WHERE id = {$post_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "post updated.";
      redirect_to("post_single.php?post_id={$post_id}");
    } else {
      // Failure
      $_SESSION["message"] = "post update failed.";
        
    }
  
  }else{
      $_SESSION["message"] = "post update failed!!";
     
  }
} else {
  // This is probably a GET request
     
} // end: if (isset($_POST['submit']))

?>
 
  <div id="page">
    <?php echo message(); ?>
    <?php //echo form_errors($errors); ?>
    
    <h2>Edit post: <?php echo htmlentities($title); ?></h2>
    <form action="edit_post.php?post_id=<?php echo $post_id; ?>" method="post">
      <p>Title:
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
      </p>
       
      <p>Content:<br />
        <textarea name="content" rows="20" cols="100"><?php echo htmlentities($post_content); ?></textarea>
      </p>
      <input type="submit" name="submit" value="Save" />
    </form>
    <br />
    <a href="post_single.php?post_id=<?php echo $post_id ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete.php?post_id=<?php echo urlencode($post_id); ?>" onclick="return confirm('Are you sure?');">Delete post</a>
    
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 