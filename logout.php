<?php require_once("functions/session.php"); require_once("functions/functions.php");
$_SESSION["user_id"] = null;
$_SESSION["email"] = null;
$_SESSION["first_name"] = null;
$_SESSION["last_name"]=null;
$_SESSION["group_name"]=null;
redirect_to("login.php");
?>