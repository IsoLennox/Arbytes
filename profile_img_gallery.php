<?php include("inc/header.php"); ?>

 <div id="page">
    <?php echo message(); 
     $user_id=$_GET['user_id'];
   
$get_member = "SELECT * FROM profile_img WHERE user_id={$user_id} LIMIT $start, $display"; 
$result = @mysqli_query ($connection, $get_member);
if($result){
    $array=mysqli_fetch_assoc($result);

}

     
 echo form_errors($errors); 
    
 
        ?>
 
 
     
     <?php

$display = 1;


   
if (isset($_GET['p']) && is_numeric($_GET['p'])) { 
    $pages = $_GET['p'];
} else {



$q = "SELECT COUNT(filepath) FROM profile_img WHERE user_id={$user_id}"; 

$r = @mysqli_query ($connection, $q); 
$row = @mysqli_fetch_array ($r, MYSQLI_NUM); 
    $records = $row[0];


if ($records > $display) {  
    $pages = ceil ($records/$display); 
} else { $pages = 1; }
    
    }//end of p IF

if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s']; 
} else { 
    $start = 0; 
} 


$q = "SELECT * FROM profile_img WHERE user_id={$user_id} LIMIT $start, $display"; 

$r = @mysqli_query ($connection, $q); 
 

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        echo "<h2 class=\"headings\"><a href=\"member_profile.php?user_id=".$array['id']."\">".$array['first_name']." ".$array['last_name']."</a></h2>";
    //PRINT RECORDS 
                       
 echo "<img src=\"".$row['filepath']."\"/>";
        
 
 
    
    
    

} // End of WHILE loop. 

mysqli_free_result ($r); 


//LINKS!!

if ($pages > 1) { 
    
    
    echo '<br /><div id="page_count">';
    $current_page = ($start/$display) + 1; 
    
    // CREATE PREVIOUS LINK
    if ($current_page != 1) { 
        echo '<a href="profile_img_gallery.php?user_id='. $user_id .'&s=' . ($start - $display) .    '&p=' . $pages . '">Previous</a> '; 
                        }// end if current page
    
    for ($i = 1; $i <= $pages; $i++ ){ 
        if ($i != $current_page) {  
            echo '<a href="profile_img_gallery.php?user_id='. $user_id .'&s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> '; 
        }else {  
            echo '<span id="current_page">'.$i . '</span> '; 
        } 
    }//end for
    
    
    
    // CREATE NEXT LINK
    
    if ($current_page != $pages) { 
        echo '<a href="profile_img_gallery.php?user_id='. $user_id .'&s=' . ($start + $display) . '&p=' . $pages . '">Next</a>'; 
    } //end next link
    
    
     echo '</div>'; 
} // End of links section. 

echo "</div>";
include("inc/footer.php"); ?> 