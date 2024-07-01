<?php
include 'connection.php';
session_start();
if(isset($_POST['submit']))
{ 
    $sql ='';
    if(!empty($_FILES['file']['name']))
    {
        $filename = $_FILES['file']['name'];
        $TMP_name = $_FILES['file']['tmp_name'];
        $sql = "update warehouse set name= '".$_POST['customer_name']."',image = '".$filename."',address='".$_POST['add']."' where id = '".$_POST['cus_id']."'";
        $folder='warehouse_image/';
        $var=move_uploaded_file($TMP_name,$folder.$filename);
    }else{
        $sql = "update warehouse set name= '".$_POST['customer_name']."',address='".$_POST['add']."' where id = '".$_POST['cus_id']."'";
    }
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Data updated Successfully";
        header('location:warehouse.php');
    }else{
        $_SESSION['error'] = "unable to update".mysqli_error($con);
        header('location:warehouse.php');
    }

}
else{
    $_SESSION['error'] = "unable to update" . mysqli_error($con);
    header('location:warehouse.php');

}
?>