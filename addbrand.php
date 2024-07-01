<?php
include 'connection.php';
session_start();
if(isset($_POST['addbnd']))
{ 
    $filename = $_FILES['fileadd']['name'];
    $TMP_name = $_FILES['fileadd']['tmp_name'];
    $sql ="insert into brand(name,image,parent_id) values('".$_POST['name']."','". $filename."','".$_POST['subcat_add']."')";
    $folder = 'brand_image/';
    $var =  move_uploaded_file($TMP_name,$folder.$filename);
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Brand Added Successfully";
        header('location:brand.php');
    }else{
        $_SESSION['error'] = "Unable to Add New Brand ".mysqli_error($con);
        header('location:brand.php');
    }

}
else{
    $_SESSION['error'] = "Some error occurred" . mysqli_error($con);
    header('location:brand.php');

}



?>