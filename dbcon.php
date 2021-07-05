<?php 
    $server='localhost';
    $user='root';
    $password='3131Rahul@Gupta';
    $database='authentication';
    $con=mysqli_connect($server,$user,$password,$database);
    if($con){
        // echo "Connected successfully";
    }
    else{
        echo "error". $con->error();
    }
?>