<?php include("inc/header.php"); ?> 
 <div id="page">
<?php

$group_id=$_GET['group_id'];


if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("profile");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create 
    $profile = mysql_prep($_POST["profile"]);
 
  
          // Perform Update

    $query  = "UPDATE group SET ";
    $query .= "profile_content = '{$profile}' "; 
    $query .= "WHERE id = {$group_id} "; 
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        //change session first name, last name, etc.
      $_SESSION["message"] = "group Profile Updated";
redirect_to("group_profile.php?group_id=$group_id");
    } else {
      // Failure
      $_SESSION["message"] = "group profile update failed.";
        
    }
  
  
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))




		$query  = "SELECT * ";
		$query .= "FROM group ";
		$query .= "WHERE id={$group_id} "; 
		$all_members = mysqli_query($connection, $query); 
       // $array= mysqli_fetch_assoc($all_members);
        
        
        if($all_members){

            foreach($all_members as $member){
                 
                 $profile=$member['profile_content']; 
                }
            }else{
        echo "something went wrong.";
            }
        



?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2 class="headings">Update group Profile</h2>
    <form action="edit_group_profile.php?group_id=<?php echo $group_id ?>" method="post">
 
      
               
      <p>Profile:<br />
        <textarea name="profile" rows="20" cols="80"><?php echo htmlentities($profile); ?></textarea>
      </p>
 
    
       
     <br/>
     <br/>
      <input type="submit" name="submit" value="Save" />
      <br/>
      <br/>
      <a href="group_profile.php?group_id=<?php echo $group_id; ?>">Cancel</a>
    </form>
    <br /> 
  </div>
</div> 
<?php include("inc/footer.php"); ?> 