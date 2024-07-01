<?php
include 'connection.php';
session_start();
if(isset($_POST['brand_id']))
{ 
    $sql ='';
    if(!empty($_FILES['file']['name']))
    {
        $filename = $_FILES['file']['name'];
        $TMP_name = $_FILES['file']['tmp_name'];
        $sql = "update brand set name='".$_POST['name']."',parent_id='".$_POST['subcat_add']."',image='".$filename."' where id='".$_POST['brand_id']."'";
        $folder='brand_image/';
        $var=move_uploaded_file($TMP_name,$folder.$filename);
    }else{
        $sql = "update brand set name='".$_POST['name']."',parent_id='".$_POST['subcat_add']."' where id='".$_POST['brand_id']."'";
    }
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Data updated Successfully";
        header('location:brand.php');
    }else{
        $_SESSION['error'] = "unable to update".mysqli_error($con);
        header('location:brand.php');
    }

}
else{
    $_SESSION['error'] = "unable to update" . mysqli_error($con);
    header('location:brand.php');

}
