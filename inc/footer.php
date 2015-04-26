<footer>
 
<!--<a href="help.php">Help</a>-->
</footer>
<?php
 //notification COUNTER

            $notify_increment  = "SELECT * FROM notify_count WHERE user_id={$_SESSION['user_id']}"; 
        $notify_increment_found = mysqli_query($connection, $notify_increment);  
                
                if(!empty($notify_increment_found)){
 $notify_count_array=mysqli_fetch_assoc($notify_increment_found);
        foreach($notify_increment_found as $notify_notification){
            $_SESSION['notify_num']=$notify_notification['count'];
        }
                    
                }



 //Message COUNTER

            $increment  = "SELECT * FROM msg_count WHERE user_id={$_SESSION['user_id']}"; 
        $increment_found = mysqli_query($connection, $increment);  
                
                if(!empty($increment_found)){
 $count_array=mysqli_fetch_assoc($increment_found);
        foreach($increment_found as $msg_notification){
            $_SESSION['msg_num']=$msg_notification['count'];
        }
                    
                }

?>
 </body>
 </html>