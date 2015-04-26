<?php require_once("functions/db_connection.php"); 







if(isset($_GET['gname'])){
    
    //Gets username value from the URL
$gname = $_GET['gname'];

//Checks if the username is available or not
$query = "SELECT * FROM groups WHERE group_name = '$gname'";

$result = mysqli_query($connection, $query);

//Prints the result
if (mysqli_num_rows($result)<1) {
	echo "<span class='green'>Group Name Available!</span>";
}
else{
	echo "<span class='red'><strong>Group Name '".$gname."' Not available!<strong></span>";
}
}//end validate group name




if(isset($_GET['uname'])){
    
    //Gets username value from the URL
$uname = $_GET['uname'];

//Checks if the username is available or not
$query = "SELECT username FROM members WHERE username = '$uname'";

$result = mysqli_query($connection, $query);

//Prints the result
if (mysqli_num_rows($result)<1) {
	echo "<span class='green'>Available!</span>";
}
else{
	echo "<span class='red'><strong>Username '".$uname."' Not available!<strong></span>";
}
}//end validate username




if(isset($_GET['email'])){
    
    //Gets email value from the URL
$email = $_GET['email'];

//Checks if the email is available or not
$query = "SELECT email FROM members WHERE email = '$email'";

$result = mysqli_query($connection, $query);

//Prints the result
if (mysqli_num_rows($result)<1) {
	echo "<span class='green'>Available!</span>";
}
else{
	echo "<span class='red'><strong>Email '".$email."' Already In Use!<strong></span>";
}
}//end validate email


if(isset($_GET['forgotemail'])){
    
    //Gets email value from the URL
$email = $_GET['forgotemail'];

//Checks if the email is available or not
$query = "SELECT email FROM members WHERE email = '$email'";

$result = mysqli_query($connection, $query);

//Prints the result
if (mysqli_num_rows($result)<1) {

    
    	echo "<span class='red'><strong>Email '".$email."' Is Not Connected An Account!<strong></span>";
}
else{
    
    	echo "<span class='green'>There you are!</span>";

}
}//end validate email

?> 