<?php include("inc/header.php"); ?> 
 <div id="page">
<?php 


//reconfigure:

//search FOR GROUPS!!

//turn search string into emplode array
if(isset($_POST['submit'])){
            echo message(); 
  echo form_errors($errors); 
    
    if(isset($_GET['go'])){
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){ 
            $query_string=$word; 
            
 
                        //USER SEARCH
            
                        
            $member_search="SELECT * FROM members WHERE first_name LIKE '%" . $query_string .  "%' OR last_name  LIKE '%" . $query_string .  "%'";
            //-run  the query against the mysql query function
            $member_result=mysqli_query($connection, $member_search);
            $member_result_array=mysqli_fetch_assoc($member_result);
 
            if(!empty($member_result_array)){
                
                echo "<h2>Members Names that contain \"". $query_string ."\":</h2>";
       
                
                   foreach($member_result as $contact_match){
                        $first  =$contact_match['first_name'];
                        $last  =$contact_match['last_name'];
                        $member_id  =$contact_match['id'];
  
                        
       
                        
                 //STYLE OUTPUT       
                        
        //SEE IF FOLLOWING
        $query  = "SELECT * ";
        $query .= "FROM following_status ";
        $query .= "WHERE you={$_SESSION['user_id']} AND following={$member_id} "; 
        $all_following_status = mysqli_query($connection, $query); 
        if($all_following_status){

                $num_rows = mysqli_num_rows($all_following_status);


            if($num_rows>=1){
            //you are following this user
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a>";
            }else{
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a>";
            }  
        } 
                  
                        
                    
                        //GET AND SHOW PROFILE IMAGE
          
                
         $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$member_id} AND current=1"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if($all_imgs){
            //user has current profile image
        $img_array= mysqli_fetch_assoc($all_imgs);
  if(!empty($img_array)){
            $avatar="<img id=\"avatar_list\" src=\"{$img_array['filepath']}\" title=\"View Profile\" />";
            
  }else{ 
       //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }
        }else{
            //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }//end GET profile image
                       
                       
                       
                       
                               //see if this person is your contact_id
            $if_contact  = "SELECT * ";
    $if_contact .= "FROM contacts ";
    $if_contact .= "WHERE user_id={$_SESSION['user_id']} "; 
    $if_contact .= "AND contact_id={$member_id} "; 
    $contact_found = mysqli_query($connection, $if_contact); 
    $contact_array = mysqli_fetch_assoc($contact_found);
        
        if(empty($contact_array)){
      
        
      
                    
           $collect= "<a href=\"add_contact.php?contact_id={$member_id}\"><i class=\"fa fa-user-plus\"></i>
 Collect Contact</a>";
            
            
            }else{ 
        $collect= "<a href=\"delete_contact.php?user_id=".$member_id."\" onclick='return confirm(\"DELETE this contact?\");'><i class=\"fa fa-user-times\"></i>
 Drop Contact</a>";
            
        }//ecd see if contact
                       
                       
                       
                       
      
  
       
            echo "<div class='contacts'<a  href=\"member_profile.php?user_id=$member_id\">".$avatar."</a><span class=\"right\">
            
            </span><a href=\"member_profile.php?user_id=".$member_id."\"><h2>".$first." ".$last."</h2></a>Email:".$contact_match['email']."<br/><br/>".$collect."<br/><a href=\"create_message.php?user_id=".$member_id."&name=".$first."%20".$last."\"><i class=\"fa fa-envelope-o\"></i>
 Send Message</a><br/><br/>".$following." Status Updates</div> ";
            
         
                    }//end foreach member found with name match
                
               
            
            }else{
               // $_SESSION["message"] = "no member results";
                $no_results-=1;
                
            }
 
                        
     //group SEARCH
            
                        
            $group_search="SELECT * FROM groups WHERE group_name LIKE '%" . $query_string .  "%'";
            //-run  the query against the mysql query function
            $group_result=mysqli_query($connection, $group_search);
            $group_result_array=mysqli_fetch_assoc($group_result);
 
            if(!empty($group_result_array)){
                
                echo "<h2>Group Names that contain \"". $query_string ."\":</h2>";
            foreach($group_result as $group){
          $group_name  =$group['group_name']; 
          $group_id  =$group['id'];
                   
  //-display the result of the array
                
    echo "<div class='group_list'><a href='posts.php?group_id={$group['id']}'><h2>".$group['group_name']."</h2></a> <p>".$group['profile_content']."</p>  
    </div> ";
                
                
  }//end loop
            
            }else{
                 //$_SESSION["message"] = "no group results";
                $no_results-=1;
                
            }//end find results
  }//end each exploded string
       
        }//end preg match
        else{
        echo "Please enter a search query";
        }
    }//END OF HEADER SEARCH
    
    
    
                   
    
  //ALL GROUPS SEARCH
      
    if(isset($_GET['all_groups'])){
        
     
                echo message(); 
  echo form_errors($errors); 

       ?>
     <h2 class="headings">Searching All Groups </h2>
       
        <form id="groupsearch" action="search.php?all_groups" method="post">
        <input type="text" name="query" value="" placeholder="Search <?php echo $group_name; ?>" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
       <?php
        
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){ 
            $query_string=$word; 
            
            
            
            
            
            //****************SEARCH GROUPS
                        $group_search="SELECT * FROM groups WHERE group_name LIKE '%" . $query_string .  "%'";
            //-run  the query against the mysql query function
            $group_result=mysqli_query($connection, $group_search);
            $group_result_array=mysqli_fetch_assoc($group_result);
 
            if(!empty($group_result_array)){
                
                echo "<h2>Group Names that contain \"". $query_string ."\":</h2>";
            foreach($group_result as $group){
          $group_name  =$group['group_name']; 
          $group_id  =$group['id'];
                   
  //-display the result of the array
                
    echo "<div class='group_list'><a href='posts.php?group_id={$group['id']}'><h2>".$group['group_name']."</h2></a> <p>".$group['profile_content']."</p>  
    </div> ";
                
                
  }//end loop
            
            }else{
                 //$_SESSION["message"] = "no group results";
                $no_results-=1;
                
            }//end find results
           
            
               
  }//end each exploded string
       
        }//end preg match
        else{
        echo "Please enter a search query";
        }
        
        
 
    }//END OF ALL GROUPS SEARCH
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  //INNER-GROUP SEARCH  
    
    if(isset($_GET['group'])){
        
        $group_id=$_GET['group'];
        
        
        
        //GET GROUP NAME
            $group_search="SELECT * FROM groups WHERE id={$group_id}";
            //-run  the query against the mysql query function
            $group_result=mysqli_query($connection, $group_search);

            if($group_result){
                $group_array=mysqli_fetch_assoc($group_result);
                $groupName=$group_array['group_name'];
            }
                echo message(); 
  echo form_errors($errors); 

       ?>
       
     <h2 class="headings">Searching 
     
    <?php 
  echo  "<a href='posts.php?group_id=".$group_id."'>".$groupName."</a>"; ?>
        
       <span  class="right"><a href="members.php?group_id=<?php echo $group_id; ?>&group_name=<?php echo $group_name; ?>"><i title="View Members" class="fa fa-users"></i></a> | <a href="group_files.php?group_id=<?php echo $group_id; ?>"><i title="View Files" class="fa fa-file-text-o"></i></a> </span>  
       
     

 </h2> 
  <form id="groupsearch" action="search.php?group=<?php echo $group_id; ?>" method="post">
  
        <input type="text" name="query" value="" />   
         <input type="submit" name="submit" value="&#xf002;" />
    </form>
       
       <?php
        
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){ 
            $query_string=$word; 
            
            
            
            
            
            //****************MEMBERS SEARCH
            
            
            //GET ALL MEMBERS IN GROUP
        $group_member_q="SELECT * FROM members_groups WHERE group_id={$group_id}";
        $group_member_result=mysqli_query($connection, $group_member_q);

        if($group_member_result){
            //THIS GROUP HAS MEMBERS
            echo "<h2>Members of ".$groupName." that contain \"". $query_string ."\":</h2>";
            
            
            //CHECK EACH MEMBER'S NAME
                foreach($group_member_result as $member){
                    
                     
            $member_search="SELECT * FROM members WHERE id={$member['member_id']} AND (first_name LIKE '%" . $query_string .  "%' OR last_name  LIKE '%" . $query_string .  "%')";
            //-run  the query against the mysql query function
            $member_result=mysqli_query($connection, $member_search);
            
             if($member_result){
              
                  //SEARCH JOINT TABLE
                  
                    foreach($member_result as $member){
                        $first  =$member['first_name'];
                        $last  =$member['last_name'];
                        $member_id  =$member['id'];
  
  
                        
       
                        
                 //STYLE OUTPUT       
                        
        //SEE IF FOLLOWING
        $query  = "SELECT * ";
        $query .= "FROM following_status ";
        $query .= "WHERE you={$_SESSION['user_id']} AND following={$member_id} "; 
        $all_following_status = mysqli_query($connection, $query); 
        if($all_following_status){

                $num_rows = mysqli_num_rows($all_following_status);


            if($num_rows>=1){
            //you are following this user
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a>";
            }else{
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a>";
            }  
        } 
                  
                        
                    
                        //GET AND SHOW PROFILE IMAGE
          
                
         $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$member_id} AND current=1"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if($all_imgs){
            //user has current profile image
        $img_array= mysqli_fetch_assoc($all_imgs);
  if(!empty($img_array)){
            $avatar="<img id=\"avatar_list\" src=\"{$img_array['filepath']}\" title=\"View Profile\" />";
            
  }else{ 
       //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }
        }else{
            //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }//end GET profile image
      
  
       
            echo "<div class='contacts'<a  href=\"member_profile.php?user_id=$member_id\">".$avatar."</a><span class=\"right\">
            
            </span><a href=\"member_profile.php?user_id=".$member_id."\"><h2>".$first." ".$last."</h2></a>Email:".$contact_match['email']."<br/><br/><a href=\"create_message.php?user_id=".$member_id."&name=".$first."%20".$last."\"><i class=\"fa fa-envelope-o\"></i>
 Send Message</a><br/><br/>".$following." Status Updates</div> ";
            
         
                    
                        
                        
 
                    }//end foreach member found with name match
                 
             }//end see if any names match query
                }//end foreach member, check name
            
            
            }else{
               //NO RESULTS
                $no_results-=1;
                
            }
 
                        
     //***************POSTS AND FILES SEARCH
            
                        
            $group_search="SELECT * FROM posts WHERE group_id={$group_id} AND (content LIKE '%" . $query_string .  "%' OR title LIKE '%" . $query_string .  "%')";
            //-run  the query against the mysql query function
            $group_result=mysqli_query($connection, $group_search);
            if($group_result){ 
             
                echo "<h2>Group Posts and Files that contain \"". $query_string ."\":</h2>";
                foreach($group_result as $file_match){
                       
                        
                            $content=$file_match['content'];

                            if($file_match['file_type']){
                            $summary = "<a href='post_single.php?post_id={$file_match['id']}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
                            }else{
                            $summary = "<a href='post_single.php?post_id={$file_match['id']}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
                            }


                            echo "
                            <div class='post_list'>
                            <h2><a href='post_single.php?post_id={$file_match['id']}'>".$file_match['title']."</a></h2> 
                            ".$file_match{'datetime'}."
                            <br/><br/> ".$summary."</div> "; 
                        
                        
                        
                        
   
                }//end foreach 
                 
            
            }else{
                 //$_SESSION["message"] = "no group results";
                $no_results-=1;
                
            }//end find results
  }//end each exploded string
       
        }//end preg match
        else{
        echo "Please enter a search query";
        }
        
        
 
    }//END OF INNER-GROUP SEARCH
    
    
    
    
    
    
        
    
    
    
    
  //CONTACTS SEARCH  
    
    if(isset($_GET['contacts'])){
        $contacts_id=$_GET['contacts'];
        
                echo message(); 
  echo form_errors($errors); 
        ?>
    <h2 class="headings">Searching Your Contacts</h2>
    <form id="groupsearch" action="search.php?contacts" method="post">
    <input type="text" name="query" value="" placeholder="Search Your Contacts  <?php echo $group_name; ?>" />   

    <!--        //submit button with font awesome icon-->
    <input type="submit" name="submit" value="&#xf002;" />
    </form> 
       
       <?php
        
        //GET contacts NAME
            $contacts_search="SELECT * FROM contacts WHERE id={$contacts_id}";
            //-run  the query against the mysql query function
            $contacts_result=mysqli_query($connection, $contacts_search);

            if($contacts_result){
                $contacts_array=mysqli_fetch_assoc($contacts_result);
                $contactsName=$contacts_array['contacts_name'];
            }
        
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){ 
            $query_string=$word;
//            echo "Query: ".$query_string."<br/>";
            
            
            
            
            
            //****************MEMBERS SEARCH
            
            
            //GET ALL MEMBERS IN contacts
        $contacts_member_q="SELECT * FROM contacts WHERE user_id={$_SESSION['user_id']}";
        $contacts_member_result=mysqli_query($connection, $contacts_member_q);

        if($contacts_member_result){
            //CONTACTS FOUND
            echo "<h2>Your Contacts that contain \"". $query_string ."\":</h2>";
            
            
            //CHECK EACH MEMBER'S NAME
        foreach($contacts_member_result as $member){
                   
                     
            $member_search="SELECT * FROM members WHERE id={$member['contact_id']} AND (first_name LIKE '%" . $query_string .  "%' OR last_name  LIKE '%" . $query_string .  "%')";
            //-run  the query against the mysql query function
            $member_result=mysqli_query($connection, $member_search);
            
             if($member_result){ 
                  
                    foreach($member_result as $contact_match){
                        $first  =$contact_match['first_name'];
                        $last  =$contact_match['last_name'];
                        $member_id  =$contact_match['id'];
  
                        
       
                        
                 //STYLE OUTPUT       
                        
        //SEE IF FOLLOWING
        $query  = "SELECT * ";
        $query .= "FROM following_status ";
        $query .= "WHERE you={$_SESSION['user_id']} AND following={$member_id} "; 
        $all_following_status = mysqli_query($connection, $query); 
        if($all_following_status){

                $num_rows = mysqli_num_rows($all_following_status);


            if($num_rows>=1){
            //you are following this user
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=0\"><i class=\"fa fa-user-times\"></i> Unfollow</a>";
            }else{
                $following = "<a href=\"follow.php?user_id={$member_id}&follow=1\"><i class=\"fa fa-user-plus\"></i> Follow</a>";
            }  
        } 
                  
                        
                    
                        //GET AND SHOW PROFILE IMAGE
          
                
         $img_query  = "SELECT * ";
		$img_query .= "FROM profile_img ";
		$img_query .= "WHERE user_id={$member_id} AND current=1"; 
		$all_imgs = mysqli_query($connection, $img_query); 
        
        if($all_imgs){
            //user has current profile image
        $img_array= mysqli_fetch_assoc($all_imgs);
  if(!empty($img_array)){
            $avatar="<img id=\"avatar_list\" src=\"{$img_array['filepath']}\" title=\"View Profile\" />";
            
  }else{ 
       //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }
        }else{
            //no image, show default user profile avatar
            $avatar="<img id=\"avatar_list\" src=\"img/default_avatar.png\" title=\"View Profile\" />";
        }//end GET profile image
      
  
       
            echo "<div class='contacts'<a  href=\"member_profile.php?user_id=$member_id\">".$avatar."</a><span class=\"right\"><a style=\"color:red\" href=\"delete.php?user_id=".$member_id."\" onclick='return confirm(\"DELETE this contact?\");'><i title=\"DELETE CONTACT\" class=\"fa fa-trash-o\"></i></a></span><a href=\"member_profile.php?user_id=".$member_id."\"><h2>".$first." ".$last."</h2></a>Email:".$contact_match['email']."<br/><br/><a href=\"create_message.php?user_id=".$member_id."&name=".$first."%20".$last."\"><i class=\"fa fa-envelope-o\"></i>
 Send Message</a><br/><br/>".$following." Status Updates</div> ";
            
            
      
 
            
            
            
            
            
            
            
            
 
                    }//end foreach member found with name match
                 
             }//end see if any names match query
                }//end foreach member, check name
            
            
            }else{
               //NO RESULTS
                $no_results-=1;
                
            }//END SEARCH CONTACTS TABLE
 
                        

  }//end each exploded string
       
        }//end preg match
        else{
        echo "Please enter a search query";
        }
        
 
        
        
    }//END OF CONTACTS SEARCH
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 //YOUR FILES SEARCH  
    
    if(isset($_GET['your_files'])){
         
                echo message(); 
  echo form_errors($errors); 
        
        ?>
    <h2 class="headings">Searching Your Files</h2>
    <form id="groupsearch" action="search.php?your_files" method="post">
    <input type="text" name="query" value="" placeholder="Search Your Files" />   

    <!--        //submit button with font awesome icon-->
    <input type="submit" name="submit" value="&#xf002;" />
    </form> 
       
       <?php
        

        
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){ 
            $query_string=$word;
//            echo "Query: ".$query_string."<br/>";
            
            
            
            
            
            //***************FILE SEARCH
            
            
           //GET FILES THAT BELONG TO USER
            $file_search="SELECT * FROM status WHERE user_id={$_SESSION['user_id']}  AND (title LIKE '%" . $query_string .  "%' OR content  LIKE '%" . $query_string .  "%')";
            //-run  the query against the mysql query function
            $file_result=mysqli_query($connection, $file_search);

            if($file_result){
                $file_array=mysqli_fetch_assoc($file_result);
                $title=$file_array['title'];
              
   
                  
                    foreach($file_result as $file_match){
                       
                        
                            $content=$file_match['content'];

                            if($file_match['file_type']){
                            $summary = "<a href='status_single.php?post_id={$file_match['id']}'><i class=\"fa fa-file-text-o fa-5x\"></i></a>";
                            }else{
                            $summary = "<a href='status_single.php?post_id={$file_match['id']}'><img onerror=\"if (this.src != 'img/default_img.png') this.src = 'img/default_img.png';\" src=\"".$content."\" /></a>";
                            }


                            echo "
                            <div class='post_list'>
                            <h2><a href='status_single.php?post_id={$file_match['id']}'>".$file_match['title']."</a></h2> 
                            ".$file_match{'datetime'}."
                            <br/><br/> ".$summary."</div> "; 
                        
                        
                        
                        
   
                }//end foreach  
            
            
            }else{
               //NO RESULTS
                $no_results-=1;
                
            }//END SEARCH CONTACTS TABLE
 
                        

  }//end each exploded string
       
        }//end preg match
        else{
        echo "<div class=\"error\">Please enter a search query</a>";
        }
        
 
        
        
    }//END OF YOUR FILES SEARCH
    
    
    
    
}
?>  

    </div>
<?php include("inc/footer.php"); ?> 