<?php require_once("functions/session.php"); 
require_once("functions/functions.php"); 
require_once("functions/db_connection.php"); 
require_once("functions/validation_functions.php"); 
confirm_logged_in(); ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="Page-Enter" content="blendTrans(Duration=1.0)"> 
        <meta http-equiv="Page-Exit" content="blendTrans(Duration=2.0)"> 
      <meta http-equiv="Refresh" content="3">
     <title>Arbytes</title>
     

     
     
      <link rel='shortcut icon' href='arbytes.ico' type='image/x-icon'/ >
<!--      <link rel="stylesheet" href="css/style.css">-->
     <style>
     .note{
    font-size: 25px;
    margin-bottom: 50px; 
    padding: 20px;
    word-wrap: break-word;
    background: white;

}
     .note a {
         text-decoration:none;
         color: black;
         font-weight:600px;
     }
     .note a:hover {color:grey;}
         
    .right {float: right;}
     </style>
     
 </head>
 <body> 
     <div id="page">
           <?php echo message(); ?>
<?php
$thread_id=$_GET['thread_id'];
$send_to=$_GET['with_id'];

//reset message notification count
   $increment_update  = "UPDATE messages SET opened=1 WHERE sent_to={$_SESSION['user_id']} AND thread_id={$thread_id}"; 
        $increment_updated = mysqli_query($connection, $increment_update);

 
$name_query  = "SELECT * FROM members ";
                $name_query .= "WHERE id={$send_to}"; 
                $name_found = mysqli_query($connection, $name_query);
                $name_array = mysqli_fetch_assoc($name_found);

//echo "<h2 class=\"headings\">Messages with <a href=\"member_profile.php?user_id={$send_to}\">".$name_array['first_name']." ".$name_array['last_name']."</a></h2>";
 ?>
        
         
<!--    <div id="message-scroll"> -->
              <div id="load"> 
              <?php
              //get messages that belong to a thread.
              //place this in its own thread reading container
        $message_query  = "SELECT * FROM messages ";
        $message_query .= "WHERE thread_id={$thread_id} ORDER BY id DESC"; 
        $all_messages = mysqli_query($connection, $message_query); 

        if (!empty($all_messages)) {
                $message_array = mysqli_fetch_assoc($all_messages);
            //echo "<div class=\"note\">";
                  foreach($all_messages as $message){
                      
                      
 
                      
                      //get user name
                $name_query  = "SELECT * FROM members ";
                $name_query .= "WHERE id={$message['sent_by']}"; 
                $name_found = mysqli_query($connection, $name_query);
                $name_array = mysqli_fetch_assoc($name_found);

    //only send to the person who is not you
                      
if ($message['sent_by'] == $_SESSION['user_id'] && $message['sent_from_keep'] ==1 || $message['sent_to'] == $_SESSION['user_id'] && $message['sent_to_keep'] ==1){ 
    
       
    echo "<div class=\"note\">";
      echo "<a href=\"delete.php?message_id=".$message['id']."&thread_id=".$thread_id."&with_id=".$send_to."\"><span class=\"right\"><i class=\"fa fa-trash-o\"></i></span></a><br/>";
     echo " ".$message['datetime']." <br/>From: ".$name_array['first_name']." ".$name_array['last_name']." <br/><br/>"; 
                    echo ""; 
                    echo $message['content']."<br/>";
                    echo "</div><hr/><br/>";     
 
}elseif ($message['sent_by'] == $_SESSION['user_id'] && $message['sent_from_keep'] ==0 || $message['sent_to'] == $_SESSION['user_id'] && $message['sent_to_keep'] ==0){
 
        }//end show or hide message if deleted by one party 
                  }//end iterate through messages in thread 
                  
              }else{
                echo "no messages with this thread id";
              }//end get messages that belong to a thread.
  
         ?>
</div><!-- end #load -->
<!--</div> end message scroll -->
</div> <!-- end page -->