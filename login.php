<?php require_once("functions/session.php");
require_once("functions/db_connection.php"); 
require_once("functions/functions.php");
require_once("functions/validation_functions.php"); ?>

<?php
$username = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];
      
		 
		$found_user = attempt_login($username, $password);

    if ($found_user) {
      // Success
       // Mark user as logged in
	   $_SESSION["user_id"] = $found_user["id"]; 
			 
        
        //get member info
        $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$found_user["id"]} LIMIT 1"; 
		$all_members = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_members);
        
        
        if($all_members){
        //member info found, create session var
            //find group info , create session var
    foreach($all_members as $member){
          
        
        $_SESSION["first_name"] = $member["first_name"]; 
        $_SESSION["last_name"] = $member["last_name"];
       
        
       redirect_to("index.php");
    }
            
        }else{
        echo "Something went wrong.";
        }//end find member ID
  
        
    } else {
      // Failure
      $_SESSION["message"] = "username/password not found.";
    }
  }
    
    
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
 <html lang="en">
  <head>
    <title>Arbytes Login</title>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
      <style>
          body, li, {
          color: #666;
          }
.message, .error{

    width: 250px;
    margin: 10px;
    padding: 5px;
    color: #eee;
    border-radius: 5px;
    background: #666;
    

} 
</style>
  </head>
  <body>
    <div id="loginpage"> 
     
<!--      <h1>Arbytes</h1>-->
 
 
 

     
 <div id="login">
   <h2>ARBYTES</h2>
     
         <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
      
    <form id="loginform" action="login.php" method="post">
      <p><input placeholder="USERNAME" type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      <p><input placeholder="PASSWORD" type="password" name="password" value="" />
      <a href="forgot_password.php"><i title="Forgot Your Password?" class="fa fa-question-circle"></i></a>
      </p>
      <input id="loginButton" type="submit" name="submit" value="Log In" /><br/>
      <br />
        <a href="new_user.php"><div id="createButton">Create New Account</div></a>
       <br/><div id="about"><a href="help_single.php?article_id=9"><!-- New To Arbytes? --></a></div><br/>
    </form>
     </div> 
       
         
      
      <!--
    ********** IF ANY PROBLEMS WITH PASSWORDS:

        <a href="reset_password.php">Reset Password</a>

-->
 
</div>