<?php include("inc/header.php");


 $group_id=$_GET['group_id'];
 $group_name=$_GET['group_name'];
 
 //link to join_group.php w/ group ID


if (isset($_POST['submit'])) {
    
 
        
        //CHECK THAT USER IS IN DB
    
    $recipient = $_POST['invite'];
 $group_id=$_GET['group_id'];
 $group_name=$_GET['group_name'];
     

$formcontent=" \r\n Go to Arbytes to Join!:\r\nhttp://arbytes.isobellennox.com/posts.php?group_id=".$group_id."\r\n";
$subject = "Invitation to Arbytes";
$mailheader = "You've been invited to join ".$group_name." on Arbytes! \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
        
       
        
    // Success
      $_SESSION["message"] = "Invitation sent to ".$recipient."!";
      redirect_to("posts.php?group_id=".$group_id.""); 
    
    
 
} else {
  // Show Form
  
} // end: if (isset($_POST['submit']))

?> 
 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2 class="headings">Invite A Member To <?php echo $group_name ?></h2>
    <form action="invite_member.php?group_id=<?php echo $group_id; ?>&group_name=<?php echo $group_name ?>" method="post">
 
<h2>From Your Contacts </h2>
       
<!--       //GET FROM YOUR CONTACTS-->
        
        
       <?php
    $query  = "SELECT * ";
    $query .= "FROM contacts ";
    $query .= "WHERE user_id={$_SESSION['user_id']} "; 
    $all_members = mysqli_query($connection, $query); 
    


    if(!empty($all_members)){
        //YOU HAVE CONTACTS
        
        //Start Select BOX
        echo "<select id=\"invite\" name=\"invite\">";
            foreach($all_members as $member){
        //GET CONTACT INFO
            $query  = "SELECT * ";
            $query .= "FROM members ";
            $query .= "WHERE id={$member['contact_id']} "; 
            $all_member_data = mysqli_query($connection, $query); 
//            $member_array= mysqli_fetch_assoc($all_member_data);
        foreach($all_member_data as $memberInfo){
        
            echo "<option name=\"email\" value=\"".$memberInfo['email']."\" >".$memberInfo['first_name']." " .$memberInfo['last_name']."</option>";
        }
                
            }
    //END SELECT BOX
        echo "</select>";
    
    }else{
        echo "You have no contacts to invite!";
    }

?>
       
       
       
       
        
      <input type="submit" name="submit" value="Send Invitation" />
    </form>
    <br /> 
  </div>
<?php include("inc/footer.php"); ?> 