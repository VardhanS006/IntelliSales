<?php
include 'connection.php';
session_start();

if(isset($_POST['submit']) && !empty($_FILES['file']['name']))
{   $sql1="select * from supplier where name = '".$_POST['supplier_name']."'";
    $query1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($query1)>=1)
    {
        $_SESSION['error']="Supplier exist";
        header('location:supplier.php');
    }
    else{
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql = "INSERT INTO supplier (name, address, phone, image, email) VALUES ('" . $_POST['supplier_name'] . "', '" . $_POST['add'] . "', '" . $_POST['ph'] . "', '" . $file_name . "', '" . $_POST['email'] . "')";
    $query= mysqli_query($con,$sql);
    if($query)
    {
        $folder='supplier_image/';
        $var=move_uploaded_file($file_tmp_name,$folder.$file_name);
        $_SESSION['success']="Data Added Successfully";
        header('location:supplier.php');
    }
    else{
        $_SESSION['error']="Data Addition failed";
        header('location:supplier.php');
    }}
}
else{
    $_SESSION['error']="Please choose file and supplier name";
        header('location:supplier.php');
}
?>