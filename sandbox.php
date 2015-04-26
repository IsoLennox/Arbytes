<?php require_once("functions/session.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?>  
 
<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>290 Project: Arbytes</title>
     <!-- Arbyte is a pun branched from the term "Arbeit" meaning 'task' or 'work' and "bytes" -->
     <link rel="stylesheet" href="css/style.css">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     
     
     
 </head>
 <body> 
<?php
$text = '<style>alert("hello!");</style><p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a><br/>okay.';
echo strip_tags($text);
echo "\n";

// Allow <p> and <a>
$stripped_text = strip_tags($text, '<p><a><img><br/><br><br />');
echo $stripped_text;
?>
 