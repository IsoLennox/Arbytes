<?php require_once("functions/session.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/db_connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php


if(isset($_GET["post_id"])){

//DELETE status POST
    
  $current_post=$_GET["post_id"];

  $query = "DELETE FROM status WHERE id = {$current_post} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "post deleted.";
    redirect_to("status.php?user_id={$_SESSION['user_id']}");
  } else{
    // Failure
    $_SESSION["message"] = "post deletion failed.";
    redirect_to("status.php?user_id={$_SESSION['user_id']}");
  }

}//END DELETE status POST



if(isset($_GET["group_id"])){

//DELETE status POST
    
  $this_group=$_GET["group_id"];

  $query = "DELETE FROM groups WHERE id = {$this_group} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
      
        $member_query = "DELETE FROM members_groups WHERE group_id = {$this_group}";
  $member_result = mysqli_query($connection, $member_query);

  if ($member_result && mysqli_affected_rows($connection) == 1) {
      
      
      
      
    // Success
    $_SESSION["message"] = "Group deleted.";
    redirect_to("status.php");
  }else{
    // Failure
    $_SESSION["message"] = "Members Could Not Be Deleted";
    redirect_to("groups.php?group_id={$_SESSION['user_id']}");
  }
  } else{
    // Failure
    $_SESSION["message"] = "Group Could Not Be Deleted";
    redirect_to("groups.php?group_id={$_SESSION['user_id']}");
  }

}//END DELETE GROUP



if(isset($_GET["parent_post_id"]) && isset($_GET["post_comment_id"])){

    //DELETE status POST COMMENT
  $current_post=$_GET["parent_post_id"];
  $id=$_GET["post_comment_id"];

  $query = "DELETE FROM status_comments WHERE id = {$id} and post_id={$current_post} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Comment Deleted.";
    redirect_to("status_single.php?post_id=$current_post");
  } else {
    // Failure
    $_SESSION["message"] = "Could not delete comment. Looks like you're stuck being a jerk forever.";
    redirect_to("status_single.php?post_id=$current_post");
  }

}//END DELETE status POST COMMENT


 

if(isset($_GET["user_id"])){
    
    //DELETE CONTACT

    $id= mysql_prep($_GET["user_id"]);

    //DELETE from Clients table where member_id = client_of

    $query= "DELETE FROM contacts WHERE contact_id='{$id}' LIMIT 1";
    $member_deleted = mysqli_query($connection, $query);

    if($member_deleted){

    $_SESSION["message"] = "Contact Deleted.";
    redirect_to("contacts.php"); 
    }else{ echo "Delete Failed."; }

}//END DELETE CONTACT


if(isset($_GET["file_id"])){
    
    //DELTE FILE

$current_file=$_GET["file_id"];

$file_query  =  "SELECT * FROM files WHERE id = {$current_file} LIMIT 1";
$all_files = mysqli_query($connection, $file_query); 


if(!empty($all_files)){
    $files_array= mysqli_fetch_assoc($all_files);
    $filepath = $files_array['filepath'];


  if(unlink($filepath)){

  $query = "DELETE FROM files WHERE id = {$current_file} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "file deleted.";
    redirect_to("files.php");
  } else {
    // Failure
    $_SESSION["message"] = "file deletion failed.";
    redirect_to("file_single.php?file_id=$current_file");
  }
      
  }else{
  echo "file not deleted";
  }
}

}//END DELETE FILE



if(isset($_GET["file_comment_id"]) && isset($_GET["parent_file_id"])){

//DELETE FILE COMMENT

  $comment_id=$_GET["file_comment_id"];
  $file_id=$_GET["parent_file_id"];

  $query = "DELETE FROM file_comments WHERE id = {$comment_id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "comment deleted.";
    redirect_to("file_single.php?file_id=$file_id");
  } else {
    // Failure
    $_SESSION["message"] = "comment deletion failed.";
    redirect_to("file_single.php?file_id=$file_id");
  }

}//END DELETE FILE COMMENT




if(isset($_GET["help_article_id"])){
//DELETE HELP ARTICLE
 $current_article=$_GET["help_article_id"];

  $query = "DELETE FROM help WHERE id = {$current_article} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "article deleted.";
    redirect_to("help.php");
  } else {
    // Failure
    $_SESSION["message"] = "article deletion failed.";
    redirect_to("help_single.php?article_id=$current_article");
  }

}//END DELETE HELP ARTICLE


if(isset($_GET['message_id']) && isset($_GET['thread_id']) && isset($_GET['with_id'])){

        //DELETE MESSAGE (SINGLE MESSAGE ON ONE USER END)

$message_id =$_GET['message_id'];
$thread_id=$_GET['thread_id'];
$send_to=$_GET['with_id']; 

 

$query = "SELECT * FROM messages WHERE id = {$message_id}";
$current_message = mysqli_query($connection, $query);
 $message_array = mysqli_fetch_assoc($current_message);

 foreach($message_array as $message_to_update){
     
    
     
     
    if($_SESSION['user_id']===$message_array['sent_by']){
    
  // Delete message from your view only, other user will still have the message.
 

    $update_query  = "UPDATE messages SET ";
    $update_query .= "sent_from_keep = '0' WHERE id = {$message_id} ";
    $update_query .= "LIMIT 1";
    $result = mysqli_query($connection, $update_query);
        
//         $_SESSION["message"] = "message ".$message_id." deleted.";
  redirect_to("read_message.php?thread_id=".$thread_id."&with_id=".$send_to."");
    }elseif($_SESSION['user_id']===$message_array['sent_to']){
    
  // Delete message from your view only, other user will still have the message.
 

    $update_query  = "UPDATE messages SET ";
    $update_query .= "sent_to_keep = '0' WHERE id = {$message_id} ";
    $update_query .= "LIMIT 1";
    $result = mysqli_query($connection, $update_query);
        
//         $_SESSION["message"] = "message ".$message_id." deleted.";
 redirect_to("read_message.php?thread_id=".$thread_id."&with_id=".$send_to."");
    
    }else{
         $_SESSION["message"] = "message update failed.";
        redirect_to("read_message.php?thread_id=".$thread_id."&with_id=".$send_to."");
    }
 }//end update per message found

}//END DELETE MESSAGE (SINGLE MESSAGE ON ONE USER END)



if(isset($_GET["note_id"])){
    
    //DELETE NOTE / POST
 $current_note=$_GET["note_id"];

  $query = "DELETE FROM posts WHERE id = {$current_note} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "note deleted.";
    redirect_to("home.php");
  } else {
    // Failure
    $_SESSION["message"] = "note deletion failed.";
    redirect_to("kb_single.php?note_id=$current_note");
  }

}//END DELETE NOTE / POST



if(isset($_GET["comment_id"]) && isset($_GET["parent_note_id"])){

    
    // DELETE COMMENT ON NOTE/POST

  $comment_id=$_GET["comment_id"];
  $note_id=$_GET["parent_note_id"];

  $query = "DELETE FROM comments WHERE id = {$comment_id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "comment deleted.";
    redirect_to("note_single.php?note_id=$note_id");
  } else {
    // Failure
    $_SESSION["message"] = "comment deletion failed.";
    redirect_to("note_single.php?note_id=$note_id");
  }

}//END DELETE COMMENT ON NOTE/POST





if(isset($_GET["notify_id"])){
    
    //DELETE NOTIFICATION
 $notify_id=$_GET["notify_id"];

  $query = "DELETE FROM notifications WHERE id = {$notify_id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Notification deleted.";
    redirect_to("notifications.php");
  } else {
    // Failure
    $_SESSION["message"] = "Notification delete failed. Looks like you keep this notification forever.";
    redirect_to("notifications.php");
  }

}//END DELETE NOTIFICATION


if(isset($_GET["filepath"])){
    //DELETE PROFILE IMMAGE
      $current_file=$_GET["filepath"];

  if(unlink($current_file)){


  $query = "DELETE FROM profile_img WHERE filepath = '{$current_file}'";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "file deleted.";
    redirect_to("member_profile.php?user_id={$_SESSION['user_id']}");
  } else {
    // Failure
    $_SESSION["message"] = "file deletion failed.";
    redirect_to("view_image.php?filepath=$current_file");
  }
      
            }else{
        echo "file not deleted:".$filepath;
        }//end unlink
    
    
}//END DELETE PROFILE IMMAGE


if(isset($_GET["article_id"])){

    //DELETE ARTICLE
    
  $current_article=$_GET["article_id"];

  $query = "DELETE FROM articles WHERE id = {$current_article} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "article deleted.";
    redirect_to("home.php");
  } else {
    // Failure
    $_SESSION["message"] = "article deletion failed.";
    redirect_to("kb_single.php?article_id=$current_article");
  }

}//END DELETE ARTICLE





if(isset($_GET["tag_id"]) && isset($_GET["article_id"])){

    //DELETE KB ARTICLE TAG
    
$article_id=$_GET["article_id"];
  $tag_id=$_GET["tag_id"];

  $query = "DELETE FROM article_tags WHERE article_id = {$article_id} AND tag_id={$tag_id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "tag deleted.";
    redirect_to("edit_tags.php?article_id={$article_id}");
  } else {
    // Failure
    $_SESSION["message"] = "tag not deleted";
    redirect_to("edit_tags.php?article_id={$article_id}");
  }}//END DELETE KB ARTICLE TAG



if(isset($_GET["theme_id"])){

    //DELTEING THEME
 $current_theme=$_GET["theme_id"];

$theme_query  =  "SELECT * FROM themes WHERE id = {$current_theme} LIMIT 1";
$all_themes = mysqli_query($connection, $theme_query); 


if(!empty($all_themes)){
    $themes_array= mysqli_fetch_assoc($all_themes);
    $filepath = $themes_array['filepath'];


  if(unlink($filepath)){
      
      
  $query = "DELETE FROM themes WHERE id = {$current_theme} LIMIT 1";
  $result = mysqli_query($connection, $query);

if($result){

  if ($result && mysqli_affected_rows($connection) == 1) {
      
      
    // Success
    $_SESSION["message"] = "theme deleted.";
    redirect_to("settings.php");
  } else {
    // Failure
    $_SESSION["message"] = "theme deletion failed.";
    redirect_to("settings.php");
  }

}
   
}else{
        echo "file not deleted:".$filepath;
        }//end unlink
    
}else{ echo "could not find this theme #".$current_theme; }


}//END SEE IF THEME IS BEING DELETED




  if(isset($_GET["cat_id"]) && isset($_GET["form_id"])){

    //DELETE CATEGORY FROM TICKET
  $cat_id=$_GET["cat_id"];
  $form_id=$_GET["form_id"];


 
$query = "DELETE FROM ticket_subcat WHERE category_id = {$cat_id}";
  $result = mysqli_query($connection, $query);
 
      
        $query = "DELETE FROM ticket_cat WHERE id = {$cat_id} LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success 
            redirect_to("edit_ticket_form.php");
        } else {
        // Failure
            $_SESSION["message"] = "category deletion failed.";
            redirect_to("edit_ticket_form.php");
        }
  }//END DELETE TICKET CATEGORY





  if(isset($_GET["subcat_id"])){
      
      // DELETE SUBCATEGORY FROM TICKET
      
      $cat_id=$_GET["subcat_id"];

  $query = "DELETE FROM ticket_subcat WHERE id = {$cat_id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success 
    redirect_to("edit_ticket_form.php");
  } else {
    // Failure
    $_SESSION["message"] = "subcategory deletion failed.";
    redirect_to("edit_ticket_form.php");
  }
  
  }//END DELETE TICKET SUBCATEGORY



?>