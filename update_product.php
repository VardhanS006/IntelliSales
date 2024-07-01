<?php
include 'connection.php';
session_start();
if(isset($_POST['product_id']))
{ 
    $sql ='';
    if(!empty($_FILES['file']['name']))
    {
        $filename = $_FILES['file']['name'];
        $TMP_name = $_FILES['file']['tmp_name'];
        $sql = "update product set category='".$_POST['cat']."',sub_category='".$_POST['subcat']."',brand='".$_POST['brnd']."',name= '".$_POST['name']."',cost_price='".$_POST['cost']."',discount_price='".$_POST['disc']."',discount='".($_POST['disc']*100)/$_POST['cost']."',selling_price='".$_POST['sp']."',manufacturing='".$_POST['mfd']."',warehouse='".$_POST['whouse']."',stock='".$_POST['sto']."',expiry='".$_POST['exp']."',image = '".$filename."' where product_id = '".$_POST['product_id']."'";
        $folder='product_images/';
        $var=move_uploaded_file($TMP_name,$folder.$filename);
    }else{
        $sql = "update product set category='".$_POST['cat']."',sub_category='".$_POST['subcat']."',brand='".$_POST['brnd']."',name= '".$_POST['name']."',cost_price='".$_POST['cost']."',discount_price='".$_POST['disc']."',discount='".($_POST['disc']*100)/$_POST['cost']."',selling_price='".$_POST['sp']."',manufacturing='".$_POST['mfd']."',warehouse='".$_POST['whouse']."',stock='".$_POST['sto']."',expiry='".$_POST['exp']."' where product_id = '".$_POST['product_id']."'";
    }
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Data updated Successfully";
        header('location:productdetail.php');
    }else{
        $_SESSION['error'] = "Data updation failed";
        header('location:productdetail.php');
    }
}
else{
    $_SESSION['error'] = "Data updation failed";
    header('location:productdetail.php');

}



?>