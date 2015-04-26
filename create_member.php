 <?php require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php");
  

 
  // validations
  $required_fields = array("first_name","last_name","email","username", "password", "confirm_password");
  validate_presences($required_fields);
  

    
    
  if (empty($errors) ) {
    // Perform Create

    $first_name = mysql_prep($_POST["first_name"]);
    $last_name = mysql_prep($_POST["last_name"]);
    $is_admin = mysql_prep($_POST["admin"]);
    $email = mysql_prep($_POST["email"]);
    $group_id = mysql_prep($_POST["group_id"]);
     
    $username = mysql_prep($_POST["username"]);
   // $hashed_password = password_encrypt($_POST["password"]);
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $first_password = $_POST["password"];
    $confirmed_password = $_POST["confirm_password"];
      
   if($first_password===$confirmed_password){
      
 
    
      //create user
    $query  = "INSERT INTO members (";
    $query .= "  group_id, first_name, last_name, username, password,email, is_admin";
    $query .= ") VALUES (";
    $query .= "  {$group_id},'{$first_name}','{$last_name}','{$username}', '{$hashed_password}','{$email}', {$is_admin}";
    $query .= ") ";
    $new_user_created = mysqli_query($connection, $query);
      
    
      
  

    if ($new_user_created) {
        
        $member_id_query="SELECT * FROM members WHERE username='{$username}'";
        $member_found= mysqli_query($connection, $member_id_query);
        $member_array=mysqli_fetch_assoc($member_found);
        $member_id=$member_array['id'];
        
        
        //                $user id=X
            
//    //INSERT msg notifications row for user.
   $insert_count  = "INSERT INTO msg_count (user_id, count) VALUES ({$member_id}, 0)";
    $new_counter_created = mysqli_query($connection, $insert_count);
 
        
           //INSERT notifications count row for user.
   $insert_notify_count  = "INSERT INTO notify_count (user_id, count) VALUES ({$member_id}, 0)";
    $new_notify_counter_created = mysqli_query($connection, $insert_notify_count);
        
        
        
    // Success
      $_SESSION["message"] = "Account created! Please Log In!";
 
      redirect_to("login.php?username=$username&password=$first_password");
        
        echo "yay!";
    } else {
      // Failure
     $_SESSION["message"] = "Username '$username' Taken!";
        redirect_to("join_group.php?group_id=$group_id");

    }
  }elseif($first_password!==$confirmed_password){
   $_SESSION["message"] = "Passwords Do Not Match!";
   }
    }//end confirm no errors in form
