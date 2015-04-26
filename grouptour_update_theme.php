<?php include("inc/tourheader.php"); ?> 
 <div id="page">
<?php

$selected_theme=$_GET['color'];
          // Perform Update


		$themequery  = "SELECT * ";
		$themequery .= "FROM themes ";
		$themequery .= "WHERE id={$selected_theme} "; 
		$themequery_found = mysqli_query($connection, $themequery); 
        $theme_array= mysqli_fetch_assoc($themequery_found);
        $filepath=$theme_array['filepath'];
           
//GREY THEME
if($theme==0){ ?>
<!--  DEFAULT GREY THEME -->
   <link rel='stylesheet' type='text/css' href='css/grey.css' />

    <?php }else{ ?>
      
   
   <?php if(!empty($filepath)){ ?>
   <link rel='stylesheet' type='text/css' href='<?php echo $filepath; ?>' />
    <? }else{ ?>
<!--  DEFAULT GREY THEME -->
   <link rel='stylesheet' type='text/css' href='css/grey.css' />
 <?php } ?>
     
     

    <?php }
 
      redirect_to("grouptour_settings.php");
 
  
 include("inc/footer.php"); ?> 