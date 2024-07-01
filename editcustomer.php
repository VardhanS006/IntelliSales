<?php
include 'connection.php';
session_start();
if(isset($_POST['cus_id']))
{ 
    $sql ='';
    if(!empty($_FILES['file']['name']))
    {
        $filename = $_FILES['file']['name'];
        $TMP_name = $_FILES['file']['tmp_name'];
        $sql = "update customer set name= '".$_POST['customer_name']."',image = '".$filename."',address='".$_POST['add']."',phone='".$_POST['pho']."',email='".$_POST['email']."' where id = '".$_POST['cus_id']."'";
        $folder='customer_image/';
        $var=move_uploaded_file($TMP_name,$folder.$filename);
    }else{
        $sql = "update customer set name= '".$_POST['customer_name']."',address='".$_POST['add']."',phone='".$_POST['pho']."',email='".$_POST['email']."' where id = '".$_POST['cus_id']."'";
    }
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Data updated Successfully";
        header('location:customer.php');
    }else{
        $_SESSION['error'] = "unable to update".mysqli_error($con);
        header('location:customer.php');
    }

}
else{
    $_SESSION['error'] = "unable to update" . mysqli_error($con);
    header('location:customer.php');

}
?>