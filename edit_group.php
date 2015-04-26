<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$group_id =$_GET['group'];


 

$query = "SELECT * FROM groups WHERE id = {$group_id}";
$current_group = mysqli_query($connection, $query);



if($current_group){
$group = mysqli_fetch_assoc($current_group);
$title =$group["group_name"];
$group_content= $group["profile_content"];
}else{
    echo "Group not found!";
    $title ="";
    $group_content ="";
}

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

    $query  = "UPDATE groups SET ";
    $query .= "group_name = '{$title}', ";
    $query .= "profile_content = '{$content}' ";
    $query .= "WHERE id = {$group_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Group updated.";
      redirect_to("posts.php?group_id={$group_id}");
    } else {
      // Failure
      $_SESSION["message"] = "group update failed.";
        
    }
  
  }else{
      $_SESSION["message"] = "group update failed!!";
     
  }
} else {
  // This is probably a GET request
     
} // end: if (isset($_group['submit']))

?>
 
  <div id="page">
    <?php echo message(); ?>
    <?php //echo form_errors($errors); ?>
    
    <h2>Edit group: <?php echo htmlentities($title); ?></h2>
    <form action="edit_group.php?group=<?php echo $group_id; ?>" method="POST">
      <p>Group Name:
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
      </p>
       
      <p>Group Description:<br />
        <textarea name="content" rows="20" cols="100"><?php echo htmlentities($group_content); ?></textarea>
      </p>
      <input type="submit" name="submit" value="Save" />
    </form>
    <br />
    <a href="posts.php?group_id=<?php echo $group_id ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete.php?group_id=<?php echo urlencode($group_id); ?>" onclick="return confirm('Are you sure?');">Delete group</a>
    
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 