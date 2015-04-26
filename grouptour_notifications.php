<?php include("inc/tourheader.php"); ?>
<div id="page">
 

    <h2>Notifications</h2>


<!--    <p> Sort by: Type, Month, Day, Year</p>-->
 
<hr/>
<?php
 
            
                echo "<div class='note'> Date Time "; 
                echo "<span class=\"right\"><a href=\"#\"><img src=\"img/icons/delete.png\"/></a></span><br/><br/>"; 
                echo "You have a new message from Member Name!"; 
                echo "<br/><br/></div>"; 

                echo "<div class='note'> Date Time "; 
                echo "<span class=\"right\"><a href=\"#\"><img src=\"img/icons/delete.png\"/></a></span><br/><br/>"; 
                echo "Member Name has commented on your post <a href='grouptour_note_single.php'>Public Post Title</a>!"; 
                echo "<br/><br/></div>"; 

                echo "<div class='note'> Date Time "; 
                echo "<span class=\"right\"><a href=\"#\"><img src=\"img/icons/delete.png\"/></a></span><br/><br/>"; 
                echo "<a href='grouptour_profile.php'>Member Name</a> has joined the group!"; 
                echo "<br/><br/></div>"; 
            


                echo "<div class='note'> Date Time "; 
                echo "<span class=\"right\"><a href=\"#\"><img src=\"img/icons/delete.png\"/></a></span><br/><br/>"; 
                echo "Member Name has uploaded the file: <a href='grouptour_file_single.php'>File Title</a> !"; 
                echo "<br/><br/></div>"; 
?>


</div>
<?php include("inc/footer.php"); ?> 