<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); confirm_logged_in();
header("Content-type: text/css; charset: UTF-8");
?>
<style>
    
    <?php

		$query  = "SELECT * ";
		$query .= "FROM employees ";
		$query .= "WHERE id={$_SESSION['user_id']} "; 
		$theme_found = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($theme_found);
        $theme= $array['theme']; 
           
//GREY THEME
if($theme=0){
    ?>
    
/*    GREY THEME*/

body {background: lightgrey; }

header a{ color: white;}

header{ 
    background: #494949; 
    color: white;  
}

#page {background: white; }

aside {background: whitesmoke; }
     
aside a{color: grey; } 
    
aside ul a:hover{ color: #535353;}

footer a {color: white;}

.note, .article, .singlenote {
    border: 1px solid grey;
    background: #f4f4f4;
}

.singlenote { background: #CECECE; }
    
.result{margin-bottom:  border: 1px solid #00A2FF;}

.message{ background: #2C2C2C; } 
    
#messages_notification{color: #9DD3B9;}

.headings{  background: #9DD3B9; padding: 10px;}


/* MEDIA QUERIES */

@media (max-width: 1000px) {
    nav{ background: whitesmoke; } 
    nav ul a:hover{ color: #535353;}   
}
    
    
    <?php
    } //END GREY THEME
        ?>
</style>