<?php include("inc/header.php"); 

     
  // Process the form
  
  // validations
  $required_fields = array("title","content");
  validate_presences($required_fields);
 
  if (empty($errors) ) {
    // Perform Create

    $title = mysql_prep($_POST["title"]);
    $content = mysql_prep($_POST["content"]);
 
    $dateTimeVariable = date("F j, Y \a\t g:ia");
      //create user
    $query  = "INSERT INTO help (";
    $query .= "  title, content";
    $query .= ") VALUES (";
    $query .= " '{$title}', '{$content}'";
    $query .= ") ";
    $new_note_created = mysqli_query($connection, $query);
      
    
      
  

    if ($new_note_created) {

        
 
        
    // Success
      $_SESSION["message"] = "Help Article Created!";
      redirect_to("help.php"); 
    } else {
      // Failure
     $_SESSION["message"] = "Article Failed!";

    }
 
    }//end confirm no errors in form
