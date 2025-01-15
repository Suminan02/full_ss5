<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login success</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<?php
session_start();

 if(isset($_SESSION['username'])&& $_SESSION['username']!=''){
    echo "username :"."".$_SESSION['username']."";
 }else{
    header("Location:loginpage.php");
    exit;
    echo "login fail";
    
 }
?>

<a href="logout.php"><button type="button" id="btnlogout" >Back to logout</button></a>
<a href="loginpage.php"><button type="button" id="btnlogin" >Back to login</button></a>
</body>
</html>

