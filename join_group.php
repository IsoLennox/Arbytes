<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
     <link rel="stylesheet" href="css/style.css">
 <div id="page">
<?php

$group_id=$_GET['group_id'];
 

?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2 class="headings">Create Member Account</h2>
    <form action="create_member.php?group_id=<?php echo $group_id; ?>" method="post">
 
        <p>First Name:
        <input type="text" name="first_name" value="" /> </p>
        
         <p>Last Name:
        <input type="text" name="last_name" value="" /> </p>
        
        <p>Email:
        <input type="text" name="email" value="" /> </p>
       
        
        <p>Username:
        <input type="text" name="username" value="" />
      </p>

      
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
        <p>Confirm Password:
        <input type="password" name="confirm_password" value="" />
      </p>
       
      <input type="hidden" name="admin" value="0" >
      <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" >
     
     <br/>
     <br/>
      <input type="submit" name="submit" value="Create Member" />
    </form>
    <br /> 
  </div>
</div>  