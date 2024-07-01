<?php
include 'connection.php';
session_start();

if(isset($_POST['submit']) && !empty($_FILES['file']['name']))
{   $sql1="select * from category where name = '".$_POST['category_name']."'";
    $query1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($query1)>=1)
    {
        $_SESSION['error']="category exist";
        header('location:adcat.php');
    }
    else{
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql="insert into category(name,image) values('".$_POST['category_name']."','".$file_name."')";
    $query= mysqli_query($con,$sql);
    if($query)
    {
        $folder='category_images/';
        $var=move_uploaded_file($file_tmp_name,$folder.$file_name);
        $_SESSION['success']="Data Added Successfully";
        header('location:adcat.php');
    }
    else{
        $_SESSION['error']="Data Addition failed";
        header('location:adcat.php');
    }}
}
else{
    $_SESSION['error']="Please choose file and category name";
        header('location:adcat.php');
}
?>