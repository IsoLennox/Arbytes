<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
 ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Arbytes</title>
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
     <link rel="stylesheet" href="css/style.css">
     <link rel='stylesheet' type='text/css' href='css/grey.css' />
          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,400italic,900italic,900' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
 
<!--
    Author: Isobel Lennox
    Created: Winter 2015
    For: Personal Development/CTEC290   
-->
    

 
 
<!--SLIDE DOWN MENU-->

    <link rel="stylesheet" href="css/slide-down.css">
    <script src="js/jquery_2.1.1.js"></script>
    <script>$(document).ready(function(){
	$("#accordian .label-title").click(function(){
		//slide up all the link lists
		$("#accordian .label-description").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})
})</script> 
 

 </head>

 <body>
     


    <header><a href="home.php"> <img id="logo" src="img/full_logo3.png" title="arbytes logo" /></a>
       <span class="right tour"><a href="tour.php">Take The Tour</a></span> <h1>Wiki</h1> 
        

 
    <form id="help_search" action="help_search.php?go" method="post">
        <input type="text" name="query" value="" placeholder="How Do I...." />  
      <input type="submit" name="submit" value="Ask" />
        </form> 
        </header>


          <div id="nav">
<?php


 


    //query to view notes that belong to your company
$query  = "SELECT * ";
		$query .= "FROM help ";
		$all_notes = mysqli_query($connection, $query); 
        $notes_array= mysqli_fetch_assoc($all_notes);

 

        if(!empty($notes_array)){ 
            echo "<h2>FAQs</h2>";
            echo "<ul>";
            foreach($all_notes as $note){
                
 
 
                
                $content=$note['content'];
                $summary = substr($content, 0, 100);
                
                 
//          echo "<div class='help_articles'><a href='help_single.php?article_id={$note['id']}'><h2>".$note['title']."</h2></a> ".$summary."... <br/><br/><a href='help_single.php?article_id={$note['id']}'>Read More</a><br/></div> "; 
          echo "<li><a href='help_single.php?article_id={$note['id']}'>".$note['title']."</li></a> "; 
            }
        echo "</ul>";
        
        
        }elseif(empty($array)){
            echo "No notes";
        }
 
?>
     </div>