<?php include("inc/header.php"); ?>  
 <div id="page">
<?php

$file_id =$_GET['file_id'];


 

$query = "SELECT * FROM files WHERE id = {$file_id}";
$current_file = mysqli_query($connection, $query);


//for each file_id, get data
$title ="";
$file_content ="";
$file = mysqli_fetch_assoc($current_file);
$title =$file["title"]; 


if (isset($_POST['submit'])) {
    
    
  // Process the form
  
   
  $title = mysql_prep($_POST["title"]); 

  // validations
  $required_fields = array("title");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("title" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $query  = "UPDATE files SET ";
    $query .= "title = '{$title}' ";
    $query .= "WHERE id = {$file_id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "file updated.";
      redirect_to("file_single.php?file_id={$file_id}");
    } else {
      // Failure
      $_SESSION["message"] = "file update failed.";
        
    }
  
  }else{
      $_SESSION["message"] = "file update failed!!";
     
  }
} else {
  // This is probably a GET request
     
} // end: if (isset($_POST['submit']))

?>
 
  <div id="page">
    <?php echo message(); ?>
    <?php //echo form_errors($errors); ?>
    
    <h2>Edit file: <?php echo htmlentities($title); ?></h2>
    <form action="edit_file.php?file_id=<?php echo $file_id; ?>" method="post">
      <p>Title:
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" />
        <input type="hidden" name="file_id" value="<?php echo $file_id; ?>" />
      </p>
       

      <input type="submit" name="submit" value="Save" />
    </form>
    <br />
    <a href="file_single.php?file_id=<?php echo $file_id ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete.php?file_id=<?php echo urlencode($file_id); ?>" onclick="return confirm('Are you sure?');">Delete file</a>
    <hr/><br/>
      
           <?php
//SHOW FILE Preview

$query  = "SELECT * ";
		$query .= "FROM files ";
		$query .= "WHERE id={$file_id} "; 
		$all_files = mysqli_query($connection, $query); 
        $files_array= mysqli_fetch_assoc($all_files);
 
        if(!empty($files_array)){ 

            foreach($all_files as $file){

                
                $filepath=$file['filepath']; 

                if($file['type']==0){
                    //is image

                echo $file{'datetime'}."<br/><img src=\"".$filepath."\" title=\"".$file['$title']."\" /> <br/><br/> "; 
                    
                }//end check file type
                
                
                if($file['type']==1){
                    //is docx, rtf, csv, or txt file
                    
                    $preview=file_get_contents($filepath, FILE_USE_INCLUDE_PATH);
                echo "  ".$file{'datetime'}." <br/><br/>Preview:<h6><em>Please note that only .txt file will be formatted for readability.<br/> .docx, .csv, and .rtf will need to be opened in your text editor of choice.</em></h6><br/><div id=\"preview\"> ".$preview." "; 
                    
                }//end check file type
                
            }//end loop through file
            
        }
            
            ?>
  </div> 
</div> 
<?php include("inc/footer.php"); ?> 