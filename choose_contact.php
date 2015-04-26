<?php include("inc/header.php");
 
        $query  = "SELECT * FROM members ";
		$query .= "WHERE id={$_SESSION['user_id']}"; 
		$all_members = mysqli_query($connection, $query); 
        
    if($all_members){    
         $array= mysqli_fetch_assoc($all_members);
             
          
            ?>
  
     <div id="page">
           <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
         
            
            <a href="messages.php">&laquo; Back to messages </a>
         <h2 class="headings">Select From Your Contacts</h2>
     
    
<?php
 
        
 
    //choose from contacts 
    $query  = "SELECT * ";
    $query .= "FROM contacts ";
    $query .= "WHERE user_id={$_SESSION['user_id']} "; 
    $all_members = mysqli_query($connection, $query); 
    
    
        if(!empty($all_members)){
         
        //get all member data for each contact_id you have added
        
        $array= mysqli_fetch_assoc($all_members);
          

    foreach($all_members as $member){
        
        
       // echo $member['contact_id']."<br/>";
 
            $query  = "SELECT * ";
            $query .= "FROM members ";
            $query .= "WHERE id={$member['contact_id']} "; 
            $all_member_data = mysqli_query($connection, $query); 
            $member_array= mysqli_fetch_assoc($all_member_data);
        foreach($all_member_data as $memberInfo){
//            echo $memberInfo['first_name']."<br/>";
            
              
            
            echo "<a href=\"create_message.php?user_id=".$memberInfo['id']."&name=".$memberInfo['first_name']."%20".$memberInfo['last_name']."\"><i class=\"fa fa-envelope\"></i>  ".$memberInfo['first_name']." ".$memberInfo['last_name']."</a> <br/><hr/><br/> ";
            
            
        }

    }
   
    }else{
    echo "You have no contacts.";
    }
    
    
 



?>
    
      

<?php
        }else{
        echo "something went wrong.";
        }
        
        ?>
</div>
<?php include("inc/footer.php"); ?> 
         
