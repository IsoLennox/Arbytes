<?php include("inc/header.php"); ?>
<?php

  

if (isset($_POST['submit'])) {
    
      
    
 
  // Process the form
  
 
      
          //CHECK IMAGE
    
    $target_dir = "uploads/".$_SESSION["user_id"]."/";
    if (!file_exists($target_dir)) {
        
        //CREATE DIR and FILE 
    mkdir($target_dir, 0777, true);
        
    require_once("inc/upload_img.php"); 
 
        
        
}else{
        
        //DIRECTORY EXISTS. UPLOAD IMAGE
    
        require_once("inc/upload_img.php"); 
    

}//end check for directory
   
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>



 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Change Profile Img</h2>

      
<form action="upload_profile_img.php" method="post" enctype="multipart/form-data">
    Select file or image to upload:
    <input type="file" name="image" id="fileToUpload"><br/>
 
    <input type="submit" value="Upload File" name="submit">
</form>
      
    <br /> 
  </div>
 
<?php include("inc/footer.php"); ?>