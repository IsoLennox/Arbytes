<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$article_id =$_GET['article_id'];


 

$query = "SELECT * FROM help WHERE id = {$article_id}";
$current_article = mysqli_query($connection, $query);


//for each article_id, get data
$title ="";
$article_content ="";
$article = mysqli_fetch_assoc($current_article);
$title =$article["title"];
$article_content= $article["content"];

 

if (isset($_POST['submit'])) {
    
    
  // Process the form
  
   
  $title = mysql_prep($_POST["title"]);
  $content = mysql_prep($_POST["content"]);
 

  // validations
  $required_fields = array("title", "content");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("title" => 60);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $query  = "UPDATE help SET ";
    $query .= "title = '{$title}', ";
    $query .= "content = '{$content}' ";
    $query .= "WHERE id = {$article_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        
               
      $_SESSION["message"] = "article updated.";
      redirect_to("help_single.php?article_id={$article_id}");
    } else {
      // Failure
      $_SESSION["message"] = "Article update failed. Please note that changes must be made to both the title and content.";
        
    }
  
  }else{
      $_SESSION["message"] = "article update failed!!";
     
  }
} else {
  // This is probably a GET request
     
} // end: if (isset($_POST['submit']))

?>
 
  <div id="page">
    <?php echo message(); ?>
    <?php //echo form_errors($errors); ?>
    
    <h2>Edit Help Article: <?php echo htmlentities($title); ?></h2>
    <form action="edit_help_article.php?article_id=<?php echo $article_id; ?>" method="post">
      <p>Article Title:
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
        <input type="hidden" name="article_id" value="<?php echo $article_id; ?>" />
      </p>
       
      <p>Content:<br />
        <textarea name="content" rows="20" cols="80"><?php echo htmlentities($article_content); ?></textarea>
      </p> <br/>
      
      
      <input type="submit" name="submit" value="Save" />
    </form>
    <br />
    <a href="help_single.php?article_id=<?php echo $article_id ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete.php?help_article_id=<?php echo urlencode($article_id); ?>" onclick="return confirm('Are you sure?');">Delete article</a>
    
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 