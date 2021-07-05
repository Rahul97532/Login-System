<?php
    session_start();

    if(!isset($_SESSION['active'])){
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>
    <h1>Welcome to home page 
    </h1>
    <h3>You are logged in successfully.</h3>
    <button class='submit' name='submit'> <a href="logout.php" style="text-decoration: none">Log Out</a> </button>

</body>
</html>