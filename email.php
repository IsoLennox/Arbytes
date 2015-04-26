<?php include("inc/header.php"); ?>
<div id="page">
<?php
//MUST BE ON LIVE SERVER
 

        $query  = "SELECT * ";
		$query .= "FROM members ";
		$group_found = mysqli_query($connection, $query); 
        $group_array= mysqli_fetch_assoc($group_found);
        $co_id=$group_array['id'];
        
        if($group_found){
            
         
$to = "isolennox@gmail.com";
$subject = "Results from query";


$body = "<table border='1'>
<tr>
<th>Name:</th> 
</tr>";

while($row = mysqli_fetch_array($group_found)){
$body.="<tr>";
$body.="<td>" . $row['first_name'] . "</td>";
$body.="</tr>";
}
$body.="</table>";

 
$headers = "From: isolennox@gmail.com";
mail($to,$subject,$body,$headers);
echo "Mail sent to $to";
            
        }else{
            echo "email not sent";
        }
?> 

</div>
<?php include("inc/footer.php"); ?> 