<?php
include 'connection.php';
session_start();

if(isset($_POST['submit']))
{   
    $sql = "INSERT INTO customer (name, address, phone, email) VALUES ('" . $_POST['customer_name'] . "', '" . $_POST['add'] . "', '" . $_POST['ph'] . "', '" . $_POST['email'] . "')";
    $query= mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success']="Data Added Successfully";
        header('location:pos.php');
    }
    else{
        $_SESSION['error']="Data Addition failed";
        header('location:pos.php');
    }
}
else{
    $_SESSION['error']="Please choose file and category name";
        header('location:pos.php');
}
?>