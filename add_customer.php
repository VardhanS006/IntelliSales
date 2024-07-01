<?php
include 'connection.php';
session_start();

if(isset($_POST['submit']))
{   
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql = "INSERT INTO customer (name, address, phone, image, email) VALUES ('" . $_POST['customer_name'] . "', '" . $_POST['add'] . "', '" . $_POST['ph'] . "', '" . $file_name . "', '" . $_POST['email'] . "')";
    $query= mysqli_query($con,$sql);
    if($query)
    {
        $folder='customer_image/';
        $var=move_uploaded_file($file_tmp_name,$folder.$file_name);
        $_SESSION['success']="Data Added Successfully";
        header('location:customer.php');
    }
    else{
        $_SESSION['error']="Data Addition failed";
        header('location:customer.php');
    }
}
else{
    $_SESSION['error']="Please choose file and category name";
        header('location:customer.php');
}
?>