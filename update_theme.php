<?php include("inc/header.php"); ?> 
 <div id="page">
<?php

$selected_theme=$_GET['color'];
          // Perform Update

    $query  = "UPDATE members SET ";
    $query .= "theme = {$selected_theme} ";
    $query .= "WHERE id = {$_SESSION['user_id']} "; 
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
        
      $_SESSION["message"] = "Account Updated.";
      redirect_to("settings.php");
    } else {
      // Failure
      redirect_to("settings.php");
        
    }
  
 include("inc/footer.php"); ?> 