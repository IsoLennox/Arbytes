<?php require_once("functions/session.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?> 
<?php

$new_id=$_GET['new_id'];


if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("username","password", "confirm_password");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create
 
    $username = mysql_prep($_POST["username"]);
     
  
   // $hashed_password = password_encrypt($_POST["password"]);
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $first_password = $_POST["password"];
    $confirmed_password = $_POST["confirm_password"];
      
   if($first_password===$confirmed_password){
      
 
 
            
             //create/insert login
    $query2  = "INSERT INTO logins (";
    $query2 .= "  member_id, username, password";
    $query2 .= ") VALUES (";
    $query2 .= "  {$new_id},'{$username}', '{$hashed_password}'";
    $query2 .= ") ";
    $new_login_created = mysqli_query($connection, $query2);
    
      
  

    if ($new_login_created) {
 
        
    // Success
      $_SESSION["message"] = "Admin created! Please Log In.";
       
      redirect_to("login.php");
       
    } else {
      // Failure due to unique constraint
     $_SESSION["message"] = "Username Taken!";

    }//end create login
             
  
       
       
  }elseif($first_password!==$confirmed_password){
   $_SESSION["message"] = "Passwords Do Not Match!";
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
     <!-- Arbyte is a pun branched from the term "Arbeit" meaning 'task' or 'work' and "bytes" -->
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
    
    <h2>Create Admin Login</h2>
    <form action="new_login.php?new_id=<?php echo $new_id; ?>" method="post">
 
        
    
    <p>Create a username:
        <input type="text" name="username" value="" />
      </p>
      
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
        <p>Confirm Password:
        <input type="password" name="confirm_password" value="" />
      </p>
      <input type="submit" name="submit" value="Create user" />
    </form>
    <br /> 
  </div>
</div> 