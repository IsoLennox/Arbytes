<?php include("inc/header.php"); ?>
<?php

  

if (isset($_POST['submit'])) {
    
      $title = $_POST["title"];
    
    if(empty($title)){ 
        $title="Untitled";
    }
    
 
  // Process the form
  
 
      
          //CHECK IMAGE
    
    $target_dir = "themes/".$_SESSION["user_id"]."/";
    if (!file_exists($target_dir)) {
        
        //CREATE DIR and FILE 
    mkdir($target_dir, 0777, true);
        
    require_once("inc/upload_theme.php"); 
 
        
        
}else{
        
        //DIRECTORY EXISTS. UPLOAD IMAGE
    
        require_once("inc/upload_theme.php"); 
    

}//end check for directory
   
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>



 
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Upload Theme</h2>
    <br/>
    <br/>
<?php

      
        $query  = "SELECT * ";
		$query .= "FROM themes ";
		$all_themes = mysqli_query($connection, $query); 


        
        
        
        if($all_themes){
            $array= mysqli_fetch_assoc($all_themes);
            if(!empty($array)){
                echo "Current Themes: <br/>";
            echo "<ul id=\"theme_list\">";
            foreach($all_themes as $theme){
                
               echo "<li><a href=\"update_theme.php?color={$theme['id']}\">".$theme['title']."</a> 
              <span class=\"right\"> <a href=\"".$theme['filepath']."\" ><i class=\"fa fa-download\"></i></a>   ";
              
                if($_SESSION['user_id']==$theme['author_id']){
                echo "<a href=\"delete_theme.php?theme_id=".$theme['id']."\" onclick='return confirm(\"DELETE this theme?\");' ><i style=\"color:red\" class=\"fa fa-trash-o\"></i></a> ";
                }
                
                
                        $author  = "SELECT * ";
		$author .= "FROM members WHERE id={$theme['author_id']} ";
		$all_authors = mysqli_query($connection, $author); 
        $author_array=mysqli_fetch_assoc($all_authors);
                    echo "By: ".$author_array['first_name'].$author_array['last_name'];
                
             echo "  </span>
               </li>";
            }
        }else{
             echo "There are no themes!";
            }
            echo "</ul>";
        }

?>
         <br/>
    <br/>
      
<form action="upload_theme.php" method="post" enctype="multipart/form-data">
    Select .css file to upload:
    <input type="file" name="image" id="fileToUpload"><br/>
    Title:
    <input type="text" name="title" value="" ><br/><br/>
    <input type="submit" value="Upload File" name="submit">
</form>
      
    <br /> 
  </div>
 
<?php include("inc/footer.php"); ?>