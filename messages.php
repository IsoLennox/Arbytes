<?php include("inc/header.php"); 

 

//reset message notification count
   $notify_increment_update  = "UPDATE msg_count SET count=0 WHERE user_id={$_SESSION['user_id']}"; 
        $notify_increment_updated = mysqli_query($connection, $notify_increment_update);



        $query  = "SELECT * FROM members ";
		$query .= "WHERE id={$_SESSION['user_id']}"; 
		$all_members = mysqli_query($connection, $query); 
        
    if($all_members){    
         $array= mysqli_fetch_assoc($all_members);
             
       
 
            ?>
  
     <div id="page">
      
           <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
<!--       <h3><a href="choose_contact.php"><i class="fa fa-pencil"></i> Compose New Message </a></h3>-->
       <h3><i class="fa fa-pencil"></i> Compose New Message</h3>
       <?php
                   //START SELF SUBMIT FORM
 echo "<form action=\"go.php\" method=\"POST\">";           
 echo "<select id=\"maillist\" name=\"maillist\" onchange=\"this.form.submit()\" >";
       echo "<option name=\"group\" value=\"\" >Your Contacts</option>";
        
        
        
        //FIND CONTACTS
         
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
            
              
            
//            echo "<a href=\"create_message.php?user_id=".$memberInfo['id']."&name=".$memberInfo['first_name']."%20".$memberInfo['last_name']."\"><i class=\"fa fa-envelope\"></i>  ".$memberInfo['first_name']." ".$memberInfo['last_name']."</a> <br/><hr/><br/> ";
           
            echo "<option name=\"user_id\" value=\"".$memberInfo['id']."\" >".$memberInfo['first_name']." ".$memberInfo['last_name']."</option>";
            
        }

    }
   
    }else{
    echo "You have no contacts.";
    }
        
 
            
               echo "</select></form>"; 
               
               ?>
               <hr/> 
               
               
       <h2 class="headings">Your Private Messages</h2>
 
      <br/>
        
<?php
            

        
         //get threads that you are invloved in
        $thread_query  = "SELECT * FROM thread WHERE user1={$_SESSION['user_id']} OR user2={$_SESSION['user_id']} "; 
        $thread_retrieved = mysqli_query($connection, $thread_query);
        $thread_retrieved_array = mysqli_fetch_assoc($thread_retrieved);
      
      if (!empty($thread_retrieved)) {
     // echo "<div class=\"post\">You have messages.</div>";
          
          foreach($thread_retrieved as $thread){
              
              //echo $thread['id'];

     
              
           
              //print a container between you and a person, link to thread messages.
 
//get messages went here before moved.  
              
              //GET OTHER USER NAME
        $user_query  = "SELECT * FROM members WHERE id={$thread['user1']} OR id={$thread['user2']}"; 
        $users_retrieved = mysqli_query($connection, $user_query);
        $users_retrieved_array = mysqli_fetch_assoc($users_retrieved);
              
             foreach($users_retrieved as $user){
                 
           
                 if($user['id']!=$_SESSION['user_id']){
                     
                     
          //get messages with thread id
        // give each message read/unread icon

        $thread_query  = "SELECT * FROM messages WHERE thread_id={$thread['id']} AND sent_by={$user['id']} AND opened ='0' ORDER BY id DESC LIMIT 1"; 
        $thread_retrieved = mysqli_query($connection, $thread_query);
        $thread_retrieved_array = mysqli_fetch_assoc($thread_retrieved);
               
                     
      if (empty($thread_retrieved_array)) {
          
       echo "<i class=\"fa fa-envelope-o\"></i>";
      }elseif (!empty($thread_retrieved_array)){
         
      echo "<i class=\"fa fa-exclamation-circle\"></i>
";
      }
                  
//                 echo "<div class=\"post\">";
                 echo "<a href=\"read_message.php?thread_id=".$thread['id']."&with_id=".$user['id']."\">";
                     echo "  Conversation with ".$user['first_name']." ".$user['last_name']."<br/>";
                     echo "</a></br>";
//                     echo "<div>";
                 }
                      }
              
              
              
          }//end loop through each thread you are invloved in.
      
      }else{
      echo "<div class=\"post\">No messages.</div>";
      }
            
         ?>
         
 
 


</div>
            
            
        
</div> 

<?php
        }else{
        echo "something went wrong.";
        }
        
        ?>
</div>
<?php include("inc/footer.php"); ?> 
         
