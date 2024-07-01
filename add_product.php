<?php
session_start();
include 'connection.php';

if(isset($_POST['add_p']) && !empty($_FILES['file']['name']))
{ 
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql ="insert into product(name,category,sub_category,brand,cost_price,discount_price,discount,selling_price,manufacturing,stock,stock_alert,expiry,image,product_code,warehouse) values('".$_POST['product_name']."','".$_POST['cat']."','".$_POST['subcat']."','".$_POST['brnd']."','".$_POST['cprice']."','".$_POST['dprice']."','".$_POST['disc']."','".$_POST['sprice']."','".$_POST['mandate']."','".$_POST['stck']."','".$_POST['stckalert']."','".$_POST['expdate']."','".$file_name."','".$_POST['product_code']."','".$_POST['wareh']."')";
    $query = mysqli_query($con,$sql);
 if($query)
 {
    $folder = 'product_images/';
    $var =  move_uploaded_file($file_tmp_name,$folder.$file_name);
    $_SESSION['success'] ="Product Added Successfully";
    header('location:product.php');
 }
 else{
        $_SESSION['error'] = "Something Went wrong";
        header('location:product.php');
 }
   
}
else{
    $_SESSION['error'] = "Please fill in all the details to Add the Product";
    header('location:product.php');
  
}
