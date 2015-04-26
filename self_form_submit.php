<?php include("inc/header.php"); ?> 
<?php 
    $selected='';

    function get_options($select){
    
        $countries = array('Please Select'=>'','India'=>'I','USA'=>2, 'Japan'=>3);
        $options= "";
        while(list($key, $val)=each($countries)){
            
            if($select==$val){
                
                $options.="<option value=\"".$val."\" selected>".$key."</option>";
            
            }else{
                $options.="<option value=\"".$val."\">".$key."</option>";
            }
        
            }
     
        return $options;
    
    }

if(isset($_POST['countries'])){
    $selected= $_POST['countries'];
    echo $selected;
}


?>
<div id="page"> 
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
     
     <select name="countries" onchange="this.form.submit();">
         <?php echo get_options($selected); ?>
         
     </select>
     
 </form>
 
</div>  
<?php include("inc/footer.php"); ?> 