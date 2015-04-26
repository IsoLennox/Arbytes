<?php include("inc/header.php");
    
$title_raw = $_POST["title"]; 
 $title= strip_tags($title_raw, '<p><a><img><br/><br><br />');
$group_id=$_GET['group_id'];
$group_name=$_GET['group_name'];
    
    if(empty($title)){ 
        $title="Untitled";
    }


    
 
  // Process the form
  
 
      
          //CHECK FOR DIR
    
    $target_dir = "uploads/".$_SESSION["user_id"]."/";
    if (!file_exists($target_dir)) {
        
        //CREATE DIR and FILE 
    mkdir($target_dir, 0777, true);
        
    require_once("inc/upload_file.php"); 
 
        
        
}else{
        
        //DIRECTORY EXISTS. UPLOAD IMAGE
    
        require_once("inc/upload_file.php"); 
    

}//end check for directory