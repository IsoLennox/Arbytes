<?php include("inc/header.php"); ?> 
 <div id="page">
       <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
   
   <?php

$group_id=$_GET['group_id'];
   
        $query  = "SELECT * FROM groups ";
		$query .= "WHERE id={$group_id}"; 
		$all_clients = mysqli_query($connection, $query); 
        
        
        
        if($all_clients){
            
         $array= mysqli_fetch_assoc($all_clients);

            ?>
 
    <h1 class="headings"><?php echo $array['group_name']; ?></h1>
     
    <?php
                if($group_id==$_SESSION['group_id']){
                echo "<a href='edit_group_profile.php?group_id={$_SESSION['group_id']}'><img src=\"img/icons/tiny-newpost.png\"/> Edit group Profile</a>";
            } ?> 
   <br/>
   <br/>
   <br/>
        	<?php	  
      if($array['is_group']==1){  		  
        		  ?>
         		  <div class="tabbedPanels">
			<ul class="tabs">
  <li><a href="#panel1" tabindex="1">Contact Info</a></li>
  <li><a href="#panel2" tabindex="2">Admins</a></li>
  <li><a href="#panel3" tabindex="3">KB Articles</a></li>
<!--  <li><a href="#panel3" tabindex="3">Invoices</a></li>-->
<!--  <li><a href="#panel4" tabindex="4">Our Meetings</a></li>-->
 
</ul>
<div class="panelContainer">
<div id="panel1" class="panel">
 
 <h2>Contact Info</h2>
<!-- //INSERT group_PROFILE // CONTACT TABLE-->
 
 <?php
            
            
            
            
            
                       
            
            
            
            $query  = "SELECT * ";
		$query .= "FROM groups ";
		$query .= "WHERE id={$array['id']} "; 
		$group_found = mysqli_query($connection, $query); 
       // $array= mysqli_fetch_assoc($all_members);
        
        
        if($group_found){

            foreach($group_found as $group){
                
                  
                if(!empty($group['profile_content'])){
                echo $group['profile_content'];
                }else{
                    echo "This group has not created a profile.";
                    
                }
                
                }
            }else{
        echo "something went wrong.";
            }
        ?>
 
</div>


<div id="panel2" class="panel">
<h2>Admins of  <?php foreach($all_clients as $client){
               echo $client['group_name'];  } ?></h2>
<?php	$query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE group_id={$group_id} AND is_admin=1"; 
		$all_members = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_members);
        
        
        if($all_members){

            foreach($all_members as $member){
                echo "<div id='collect' class='note'><a href='member_profile.php?user_id={$member['id']}'>".$member['first_name']." ".$member['last_name']."</a> ";
                
                 //see if this person is your contact_id
            $if_contact  = "SELECT * ";
    $if_contact .= "FROM contacts ";
    $if_contact .= "WHERE user_id={$_SESSION['user_id']} "; 
    $if_contact .= "AND contact_id={$member['id']} "; 
    $contact_found = mysqli_query($connection, $if_contact); 
    $contact_array = mysqli_fetch_assoc($contact_found);
        
        if(empty($contact_array)){
        
        
        if($member['id']!==$_SESSION['user_id']){
            echo "<span class=\"right\"><a href=\"create_message.php?user_id=".$member['id']."&name=".$member['first_name']."%20".$member['last_name']."\"><img src=\"img/icons/tiny-messages.png\"/> Send Message</a> | <a href=\"add_contact.php?contact_id={$member['id']}\"><img src=\"img/icons/tiny-contacts.png\" /> Collect Contact</a></span>";
            }elseif($member['id']==$_SESSION['user_id']){
            echo "<span class=\"right\">Your Account</span>";
            }
            
            
        }else{
             if($member['id']!==$_SESSION['user_id']){
            echo "<span class=\"right\"><a href=\"create_message.php?user_id=".$member['id']."&name=".$member['first_name']."%20".$member['last_name']."\"><img src=\"img/icons/tiny-messages.png\"/> Send Message</a> | <a href=\"delete_contact.php?user_id=".$member['id']."\" onclick='return confirm(\"DELETE this contact?\");'><img src=\"img/icons/drop-contacts.png\"/> Drop Contact</a></span>";
             } 
        }//end see if this person is your contact
                
                echo "<br/><br/>Email: {$member['email']} </div> "; 
            }
             


        }
    ?>
    </div>
    
    



<div id="panel3" class="panel">
 <h2>Articles From <?php foreach($all_clients as $client){
               echo $client['group_name'];  } ?></h2>
 <?php	$artquery  = "SELECT * ";
		$artquery .= "FROM articles ";
		$artquery .= "WHERE group_id={$group_id} ORDER BY id DESC"; 
		$all_articles = mysqli_query($connection, $artquery); 
        $artarray= mysqli_fetch_assoc($all_articles);
        
        
        if($all_articles){

            foreach($all_articles as $article){
                echo "<div class='note'><a href='kb_single.php?article_id={$article['id']}'>".$article['title']."</a><span class='right'>Published: {$article['datetime']}</span></div> "; 
            }


        }
    ?>
</div>             
                      </div>
  
</div><!-- end tabbed panels -->
<?php
          
//         include("inc/footer.php");  
     }else{
      
          echo "<div class=\"profile\">".$array['profile_content']."</div>";
     
     }

 
        }else{
        echo "something went wrong.";
        } ?>
</div>