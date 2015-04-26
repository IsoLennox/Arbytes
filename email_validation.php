<?php require_once("functions/db_connection.php"); 

//Gets email value from the URL
$email = $_GET['email'];

//Checks if the email is available or not
$query = "SELECT email FROM members WHERE email = '$email'";

$result = mysqli_query($connection, $query);

//Prints the result
if (mysqli_num_rows($result)<1) {
//	echo "<span class='green'>Available!</span>";
    echo "<span class='red'><strong>Email Address: '".$email."' Not Linked to any accounts!<strong></span>";
}
?> 