<?php include("inc/header.php"); ?> 

<?php
 
		$query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$_SESSION['user_id']} "; 
		$all_members = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_members);
        
        
        if($all_members){

            foreach($all_members as $member){
                
                $email=$member['email'];
                $username=$member['username'];
                $profile=$member['profile'];
            }
        }else{
        echo "something went wrong.";
        }
?>




 
     <div id="page">
        		  <?php echo message(); ?>
        		  <h1>Settings</h1>
         		  <div class="tabbedPanels">
			<ul class="tabs">
  <li><a href="#panel1" tabindex="1">Contact Info</a></li>
  <li><a href="#panel2" tabindex="2">Account</a></li>
  <li><a href="#panel3" tabindex="3">Colors</a></li> 
 
</ul>
<div class="panelContainer">
<div id="panel1" class="panel">
 
 <h2>Contact Info</h2>
 
<!-- <p>[Profile Image]</p>-->
 <p>First Name: <?php echo $_SESSION["first_name"]; ?></p>
 <p>Last Name:<?php echo $_SESSION['last_name']; ?></p>
 <p>Email:<?php echo $email; ?></p> 
 <h3><a href="edit_contact_info.php?user_id=<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i> Edit</a></h3>
 
</div>


<div id="panel2" class="panel">
 <h2>Account Settings</h2>
 

 <p>Userame: <?php echo $username; ?></p>
 <p>Password:  ********</p>
 
 
 <h3><a href="update_login.php?user_id=<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-pencil"></i>  Edit</a></h3>
  
     <br/><Br/><br/><span class='right'><a href='drop_member.php?user_id=<?php echo $_SESSION['user_id']; ?>' onclick='return confirm(\"Permenantly DELETE this member?\");'><i class="fa fa-trash-o"></i>  Delete Account</a></span><br/><br/> 
                
   
    </div>



<div id="panel3" class="panel">
 <h2>Color Settings</h2>
 <br/>

<a href="upload_theme.php" ><i class="fa fa-upload"></i> Upload a Theme</a>
  <br/>
 <br/>
  <br/>
 
 <?php

        $query  = "SELECT * ";
		$query .= "FROM themes ";
		$all_themes = mysqli_query($connection, $query); 


        
        
        
        if($all_themes){
            $array= mysqli_fetch_assoc($all_themes);
            if(!empty($array)){
                echo "Current Themes: <br/>";
            echo "<ul id=\"theme_list\">";
            foreach($all_themes as $theme){
                
               echo "<li><a href=\"update_theme.php?color={$theme['id']}\">".$theme['title']."</a> 
              <span class=\"right\"> <a href=\"".$theme['filepath']."\" ><i class=\"fa fa-download\"></i></a>   ";
              
                if($_SESSION['user_id']==$theme['author_id']){
                echo "     <a href=\"delete.php?theme_id=".$theme['id']."\" onclick='return confirm(\"DELETE this theme?\");' ><i class=\"fa fa-trash-o\"></i></a> ";
                }
                
                
                        $author  = "SELECT * ";
		$author .= "FROM members WHERE id={$theme['author_id']} ";
		$all_authors = mysqli_query($connection, $author); 
        $author_array=mysqli_fetch_assoc($all_authors);
                    echo "By: ".$author_array['first_name'].$author_array['last_name'];
                
             echo "  </span>
               </li>";
            }
        }else{
             echo "There are no themes!";
            }
            echo "</ul>";
        }

?>
 
 <br/>
 <br/>


 
 
</div>

 
 
</div>
 
 

</div>
</div><!-- end tabbed panels -->
 
<?php include("inc/footer.php"); ?> 