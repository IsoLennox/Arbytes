<?php require_once("functions/session.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?>  
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
     <link rel="stylesheet" href="css/style.css">
     <link rel='stylesheet' type='text/css' href='css/grey.css' />
 
<!--
    Author: Isobel Lennox
    Created: Winter 2015
    For: Personal Development/CTEC290   
-->
 

     
     <!-- Arbyte is a pun branched from the term "Arbeit" meaning 'task' or 'work' and "bytes" -->


<!--
This page:

* gets user emailchecks if email exists
* if exists: send email with link to reset password, using userID in URL
* URL only good for 24 hours
-->
 

 </head>
 <body>
    <header> 
      <a href="home.php"> <img id="logo" src="img/full_logo3.png" title="arbytes logo" /></a>
    </header>
    
 
 <div id="nonpage">
<?php

 
//this is the form to send an email of the link to reset_password

if (isset($_POST['submit'])) {
     
  // Process the form
  
  // validations
  $required_fields = array("email");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create 
    $recipient= $_POST["email"];
 
      
    //FIND USER ID

    //Checks if the email is available or not
    $query = "SELECT * FROM members WHERE email = '$recipient' LIMIT 1";

    $result = mysqli_query($connection, $query);

    //Prints the result
    if ($result) {
        $user_array=mysqli_fetch_assoc($result);
        $user_id=$user_array['id'];
        $username=$user_array['username'];

  
    
        //CHECK THAT USER IS IN DB
 
     

$formcontent=" \r\n You have requested a password reset on Arbytes. \r\n Go to Arbytes to reset your password for ' $username ':\r\nhttp://arbytes.isobellennox.com/reset_password.php?user_id=".$user_id."&token=".time()."\r\nThis link will be good for one hour.";
$subject = "Password Reset On Arbytes";
$mailheader = "Follow the link to reset your password \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
        
       
        
    // Success
      $_SESSION["message"] = "Reset link sent to ".$recipient."!";
      redirect_to("login.php"); 
    
    
    }else{
       $user_id="error";
    }
 
 
    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 
 
 <head>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     
     
     
     <script>
 
         
 //check IF EMAIL IS IN DB OR NOT EMPTY
       $(document).ready(function () {
    $("#email").blur(function () {
      var email = $(this).val();
      if (email == '') {
        $("#eavailability").html("");
           $("#e-error input").css({"border": "5px solid #E43633"});
      }else{
          $("#e-error input").css({"border": "1px solid grey"});
        $.ajax({
          url: "validation.php?forgotemail="+email
        }).done(function( data ) {
          $("#eavailability").html(data);
        });   
      } 
    });
  });
 
          
     </script>
   </head>
 
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Reset Your Password</h2>
    <form action="forgot_password.php" method="post">
 
 <p id="e-error">Enter Your Email:
        <input type="text" name="email" id="email" value="" /> </p>
        <div id="eavailability"></div>
        
        
       
     <br/>
     <br/>
      <input type="submit" name="submit" value="Reset" />
    </form>
    <br/>
    <br/>
    <a href="settings.php">Cancel</a>
    <br /> 
  </div>
</div> 
 <?php include("inc/footer.php"); ?> 