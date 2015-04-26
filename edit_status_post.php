<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$post_id =$_GET['post_id'];


 

$query = "SELECT * FROM status WHERE id = {$post_id}";
$current_post = mysqli_query($connection, $query);


//for each post_id, get data
$title ="";
$post_content ="";
$post = mysqli_fetch_assoc($current_post);
$title_raw =$post["title"];
$title= strip_tags($title_raw, '<p><a><img><br/><br><br />');
$post_content= $post["content"];
$current_private= $post["is_private"];


if (isset($_POST['submit'])) {
    
    
  // Process the form
  
   
  $title_raw = mysql_prep($_POST["title"]);
    $title= strip_tags($title_raw, '<p><a><img><br/><br><br />');
  $content_raw = mysql_prep($_POST["content"]);
    $content= strip_tags($content_raw, '<p><a><img><br/><br><br />');
  $private = mysql_prep($_POST["private"]);

  // validations
  $required_fields = array("title", "content");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("title" => 60);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $query  = "UPDATE status SET ";
    $query .= "title = '{$title}', ";
    $query .= "is_private = {$private}, ";
    $query .= "content = '{$content}' ";
    $query .= "WHERE id = {$post_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "post updated.";
      redirect_to("status_single.php?post_id={$post_id}");
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
    <form action="edit_status_post.php?post_id=<?php echo $post_id; ?>" method="post">
      <p>Title:
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
      </p>
      
      <p>Privacy:
       <br/>Currently 
        <input type="radio" name="private" value="0" <?php if($current_private == 0){ ?> checked <?php } ?> />Public
        <input type="radio" name="private" value="1" <?php if($current_private == 1){ ?> checked <?php } ?> />Only You
      </p>
       
      <p>Content:<br />
        <textarea name="content" rows="20" cols="100"><?php echo htmlentities($post_content); ?></textarea>
      </p>
      <input type="submit" name="submit" value="Save" />
    </form>
    <br />
    <a href="status_single.php?post_id=<?php echo $post_id ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete.php?post_id=<?php echo urlencode($post_id); ?>" onclick="return confirm('Are you sure?');">Delete post</a>
    
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 