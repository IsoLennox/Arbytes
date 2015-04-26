<?php include("inc/header.php"); ?> 
 <div id="page">
<?php

 


if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("username","oldpassword", "password", "confirm_password");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
      
      $oldpassword = $_POST["oldpassword"];
      
      
      //Check that old password is correct
      		$found_user = check_password($_SESSION['user_id'], $oldpassword);

    if ($found_user) {
    //old password successful
   
      
      
      
      
    // Perform Create
     
    $username = mysql_prep($_POST["username"]);
   // $hashed_password = password_encrypt($_POST["password"]);
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $first_password = $_POST["password"];
    $confirmed_password = $_POST["confirm_password"];
      
   if($first_password===$confirmed_password){
      
 
    
  
          // Perform Update

    $query  = "UPDATE members SET ";
    $query .= "username = '{$username}', ";
    $query .= "password = '{$hashed_password}' ";
    $query .= "WHERE id = {$_SESSION['user_id']} "; 
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        
        // SEND EMAIL!!! username & confirmed password. please log in if you would like to change this information.
        
      $_SESSION["message"] = "Account Updated.";
      redirect_to("settings.php?");
    } else {
      // Failure
      $_SESSION["message"] = "Account update failed.";
        
    }
  
 
  }elseif($first_password!==$confirmed_password){
   $_SESSION["message"] = "New Passwords Do Not Match!";
   }
      
      
  }else{
    $_SESSION["message"] = "Your Old Password is Incorrect!";
  }
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))



 $username_query .= "SELECT * FROM members WHERE id = {$_SESSION['user_id']}"; 
    $result2 = mysqli_query($connection, $username_query);
    if($result2){
        $array=mysqli_fetch_assoc($result2);
        $username=$array['username'];
    }else{
        $username="non";
    }
?> 


      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     
     
     
     <script>
    //password
       $(document).ready(function () {
    $("#pass").blur(function () {
      var input = $(this).val();
      if (input == '') {
        $("#p1-error input").css({"border": "5px solid #E43633"});
      }else{
        $("#p1-error input").css({"border": "1px solid grey"});
      }
    });
  });
         
         
         
          //confirm_password
       $(document).ready(function () {
    $("#pass2").blur(function () {
      var input = $(this).val();
      if (input == '') {
        $("#p2-error input").css({"border": "5px solid #E43633"});
      }else{
        $("#p2-error input").css({"border": "1px solid grey"});
      }
    });
  });
         
         
         
         
         
          function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  
         
     
     </script>
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Update member Account</h2>
    <form action="update_login.php" method="post">
 
        
        <p>Change Username:
        <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      
        <p>Old Password:
        <input type="password" name="oldpassword" value="" />
      </p>
 
<!--
      <p>New Password:
        <input type="password" name="password" value="" />
      </p>
        <p>Confirm New Password:
        <input type="password" name="confirm_password" value="" />
      </p>
-->
      
      
      
            <p id="p1-error">New Password:
        <input type="password" name="password" id="pass" value="" />
      </p>
        <p id="p2-error">Confirm New Password: 
          <input type="password" name="confirm_password" id="pass2" value="" onkeyup="checkPass(); return false;" />
        
      </p>
     <span id="confirmMessage" class="confirmMessage"></span>
      
        <br/>
        
        
        
       
     <br/>
     <br/>
      <input type="submit" name="submit" value="Update member" />
    </form>
    <br/>
    <br/>
    <a href="settings.php">Cancel</a>
    <br /> 
  </div>
</div> 
 <?php include("inc/footer.php"); ?> 