<?php
include 'connection.php';
session_start();

if(isset($_POST['submit']) && !empty($_FILES['file']['name']))
{   $sql1="select * from warehouse where name = '".$_POST['customer_name']."'";
    $query1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($query1)>=1)
    {
        $_SESSION['error']="category exist";
        header('location:warehouse.php');
    }
    else{
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql = "INSERT INTO warehouse (name, address, image) VALUES ('" . $_POST['customer_name'] . "', '" . $_POST['add'] . "', '" . $file_name . "')";
    $query= mysqli_query($con,$sql);
    if($query)
    {
        $folder='warehouse_image/';
        $var=move_uploaded_file($file_tmp_name,$folder.$file_name);
        $_SESSION['success']="Data Added Successfully";
        header('location:warehouse.php');
    }
    else{
        $_SESSION['error']="Data Addition failed";
        header('location:warehouse.php');
    }}
}
else{
    $_SESSION['error']="Please choose file and warehouse name";
        header('location:warehouse.php');
}
?>