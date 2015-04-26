<?php 

$name = $_POST['firstname'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent="From: $name \n Message: $message";
$recipient = "contact@isobellennox.com";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

?>

<head>

<meta http-equiv="refresh" content="3;url=http://www.isobellennox.com/" />
 <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    
    <style>
    h1, p {text-align:center;}
    h1 {
    font-size: 130px; 
    font-family: 'Great Vibes', cursive;
    color: #6FC59E;
    text-shadow: 0 05px 10px #ccc;
}
        
        #userMessage{
            padding:30px;
            width:200px;
            margin: 0 auto;
            display:block;
            border: 1px solid grey;
            border-radius:20px;
        }
    
    </style>
</head>

<body>
<div id="content">
    
    <h1>Thank You!</h1>
    <p>Your message has been sent.</p>
    
    <div id="userMessage">
    <?php
echo "From: ".$name."<br/>";
echo "Message: ".$message;

?>
    
    </div>
    
    
    <p>You will be sent back home in 2 seconds...</p>
    </div>

</body>