<?php include("inc/header.php"); ?> 
 <div id="page">
<?php

 


if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("profile");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create
     
    $profile_raw = mysql_prep($_POST["profile"]);
    $profile= strip_tags($profile_raw, '<p><a><img><br/><br><br />');
  
          // Perform Update

    $query  = "UPDATE members SET ";
    $query .= "profile = '{$profile}' "; 
    $query .= "WHERE id = {$_SESSION['user_id']} "; 
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        //change session first name, last name, etc.
      $_SESSION["message"] = "Profile Updated!";
redirect_to("member_profile.php?user_id={$_SESSION['user_id']}");
    } else {
      // Failure
      $_SESSION["message"] = "Profile update failed.";
        
    }
  
  
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))




		$query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$_SESSION['user_id']} "; 
		$all_members = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_members);
        
        
        if($all_members){

            foreach($all_members as $member){
                 
                 $profile=$member['profile']; 
            }
            }else{
        echo "something went wrong.";
            }
        



?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2 class="headings">Update Profile</h2>
    <form action="edit_profile.php" method="post">
 
      <br />
        <textarea name="profile" rows="20" cols="80"><?php echo htmlentities($profile); ?></textarea>
     
 
    
       
     <br/>
     <br/>
      <input type="submit" name="submit" value="Save" />
      <br/>
      <br/>
      <a href="member_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">Cancel</a>
    </form>
    <br /> 
  </div>
</div> 
<?php include("inc/footer.php"); ?> 