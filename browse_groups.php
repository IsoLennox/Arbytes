<?php include("inc/header.php"); 

$group_id=$_GET['group_id'];
$group_name=$_GET['group_name'];


?>

 <div id="page"><?php echo message(); ?>
     <h2 class="headings">All Groups </h2>
       
        <form id="groupsearch" action="search.php?all_groups" method="post">
        <input type="text" name="query" value="" placeholder="Search <?php echo $group_name; ?>" />   
 
<!--        //submit button with font awesome icon-->
      <input type="submit" name="submit" value="&#xf002;" />
        </form> 
     
     <?php

 


$q = "SELECT * FROM groups ORDER BY id DESC"; 
$r = mysqli_query ($connection, $q); 
  
foreach ($r as $row ) {

 
            
    echo "<div class='group_list'><a href='posts.php?group_id={$row['id']}'><h2>".$row['group_name']."</h2></a> <p>".$row['profile_content']."</p>  
    </div> "; 
         

} // End of foreach loop. 

mysqli_free_result ($r); 

 

echo "</div>";
include("inc/footer.php"); ?> 