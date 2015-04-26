<?php include("inc/header.php"); ?>
<div id="page">

    <?php echo message(); ?>

    <h2>Notifications</h2>


<!--    <p> Sort by: Type, Month, Day, Year</p>-->
 
<hr/>
<?php

//reset message notification count
   $notify_increment_update  = "UPDATE notify_count SET count=0 WHERE user_id={$_SESSION['user_id']}"; 
        $notify_increment_updated = mysqli_query($connection, $notify_increment_update);
  
 
		$query  = "SELECT * ";
		$query .= "FROM notifications ";
		$query .= "WHERE user_id={$_SESSION['user_id']} "; 
		$query .= " ORDER BY id DESC"; 
		$all_notifications = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_notifications);
        
        
        if(!empty($array)){

            foreach($all_notifications as $notification){
                
            
                echo "<div class='post'>"; 
                echo $notification['datetime'];
                echo "<span class=\"right\"><a href=\"delete.php?notify_id=".$notification['id']."\"><i class=\"fa fa-trash-o\"></i></a></span><br/><br/>"; 
                echo $notification['content']; 
                echo "<br/><br/></div>"; 
            }
            
            
        }elseif(empty($array)){
        echo "No Notifications.";
        }
?>


</div>
<?php include("inc/footer.php"); ?> 