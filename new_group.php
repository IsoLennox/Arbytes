<?php include("inc/header.php");  

//Creating New group and Admin user

$group_id="";


if (isset($_POST['submit'])) {
    
    $group_id=$_GET['group_id'];
    
  // Process the form
  
  // validations
  $required_fields = array("groupName","profile_content");
  validate_presences($required_fields);
  
 
  if (empty($errors) ) {
    // Perform Create

    
    $groupName = mysql_prep($_POST["groupName"]);
      $content = mysql_prep($_POST["profile_content"]); 
     
   
    
    $query  = "select * from groups WHERE group_name='{$groupName}'"; 
    $groupName_found = mysqli_query($connection, $query);
        $groupName_array= mysqli_fetch_assoc($groupName_found);
        
        if (empty($groupName_array)){
            
            
            //create group
            
            
      //create group
    $query  = "INSERT INTO groups (";
    $query .= "  group_name, profile_content ";
    $query .= ") VALUES (";
    $query .= "  '{$groupName}', '{$content}' ";
    $query .= ") ";
    $new_group_created = mysqli_query($connection, $query);
      
    

      
  

    if ($new_group_created) {
        
              //create group
    $query  = "select * from groups WHERE group_name='{$groupName}'"; 
    $group_found = mysqli_query($connection, $query);
        $array= mysqli_fetch_assoc($group_found);
        
        if ($group_found){
            $group_id = $array["id"];
            $group_name = $array["group_name"];
            
            
                     //create/insert member
    $query  = "INSERT INTO members_groups (";
    $query .= "  group_id, member_id, is_admin";
    $query .= ") VALUES (";
    $query .= "  {$group_id},{$_SESSION['user_id']}, 1";
    $query .= ") ";
    $new_user_created = mysqli_query($connection, $query);
            
            
            if ($new_user_created) {
     
            
            // Success
      $_SESSION["message"] = "Group created!";
            
            //redirect to avoid duplicate member creation//if unique constraint in username violated
            redirect_to("posts.php?group_id=$group_id&group_name=$group_name");
            
            
        }else{
        
        $_SESSION["message"] = "group created, not member";
        }

            
        }else{
            $_SESSION["message"] = "group Not found??";
        }
 }else{
        $_SESSION["message"] = "group not created";
        }
        
        
    } else {
      // Failure
     $_SESSION["message"] = "Username Exists";

    }
     

    }//end confirm no errors in form
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?> 

 <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 
     <script>
     //check groupName availability
       $(document).ready(function () {
    $("#groupName").blur(function () {
      var groupName = $(this).val();
      if (groupName == '') {
        $("#availability").html("");
      }
      else{
        $.ajax({
          url: "validation.php?gname="+groupName
        }).done(function( data ) {
          $("#availability").html(data);
        });   
      } 
    });
  }); 
     </script>
 </head>

 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Create Group Account</h2>
    <form action="new_group.php?group_id=<?php echo $group_id; ?>" method="post">
      <p>Group Name:
        <input type="text" name="groupName" value="" id="groupName" /> 
        <div id="availability"></div>
      </p>
      
            <p>Group Description:
                <textarea name="profile_content" value="" ></textarea>
      </p>
       
         
 
      <input type="submit" name="submit" value="Continue" />
    </form>
    <br />
    <a href="index.php">Cancel</a>
  </div>
 