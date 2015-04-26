<?php include("inc/header.php"); ?> 
 <div id="page">
<?php

 


if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("first_name", "last_name", "email");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create
     
    $first_raw = mysql_prep($_POST["first_name"]);
      $first= strip_tags($first_raw, '<p><a><img><br/><br><br />');
    $last_raw = mysql_prep($_POST["last_name"]);
      $last= strip_tags($last_raw, '<p><a><img><br/><br><br />');
    $email_raw = mysql_prep($_POST["email"]);
      $email= strip_tags($email_raw, '<p><a><img><br/><br><br />');
 
  
          // Perform Update

    $query  = "UPDATE members SET ";
    $query .= "first_name = '{$first}', "; 
    $query .= "last_name = '{$last}', "; 
    $query .= "email = '{$email}' ";  
    $query .= "WHERE id = {$_SESSION['user_id']} "; 
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        //change session first name, last name, etc.
      $_SESSION["message"] = "Account Updated. Please log back in.";
redirect_to("logout.php");
    } else {
      // Failure
      $_SESSION["message"] = "Account update failed.";
        
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
                
                 $email=$member['email'];   
            }
            }else{
        echo "something went wrong.";
            }
        



?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2 class="headings">Update member Account</h2>
    <form action="edit_contact_info.php" method="post">
 
        
        <p>First:
        <input type="text" name="first_name" value="<?php echo htmlentities($_SESSION['first_name']); ?>" />
      </p>
      
              <p>Last:
        <input type="text" name="last_name" value="<?php echo htmlentities($_SESSION['last_name']); ?>" />
      </p>
      
                    <p>Email:
        <input type="text" name="email" value="<?php echo htmlentities($email); ?>" />
      </p>
      
               
       
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