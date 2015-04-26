<?php include("inc/header.php"); ?>  
   <div id="page">
          

           <?php echo message(); ?>
<?php
$thread_id=$_GET['thread_id'];
$send_to=$_GET['with_id'];
 ?>
 
<!--
<script>
window.setInterval("reloadIFrame();", 1000);
function reloadIFrame() {
 document.getElementById("frame").src="conversation.php?thread_id=<?php echo $thread_id; ?>&with_id=<?php echo $send_to; ?>";
}
</script> 
-->

<!--       <div id="message-scroll">-->
      <?php  
               $query  = "SELECT * FROM members ";
		$query .= "WHERE id={$send_to}"; 
		$all_members = mysqli_query($connection, $query); 
        
    if($all_members){    
         $array= mysqli_fetch_assoc($all_members);
         
         ?>
         <h2>Conversation With  
        <a href="member_profile.php?user_id=<?php echo $send_to; ?>" ><?php echo $array['first_name']." ".$array['last_name']; ?></a>
         </h2>
         
         <?php } ?>
      <h6><em>*Blinking only in Chrome, please use firefox to avoid seizures and migranes.</em></h6>
       <div id="message_scroll">

           <iframe allowtransparency="true" id="frame" src="conversation.php?thread_id=<?php echo $thread_id; ?>&with_id=<?php echo $send_to; ?>"></iframe>
 </div>
<!-- <div id="message_scroll"></div>-->
 <div class="clear"></div>
   <h3>Reply:</h3>
    <form action="reply_message.php?thread_id=<?php echo $thread_id; ?>" method="post">
 
         
        <input type="hidden" name="sent_to" value="<?php echo $send_to; ?>" /> </p>
        
         <p>message: <br/>
    <textarea name="content" value="" rows="10" cols="70"></textarea></p>
         
      <input type="submit" name="submit" value="SEND" />
    </form>
</div>

  
    <br />

<?php include("inc/footer.php"); ?> 
         
