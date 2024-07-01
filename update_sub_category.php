<?php
include 'connection.php';
session_start();
if(isset($_POST['cat_id']))
{ 
    $sql ='';
    if(!empty($_FILES['file']['name']))
    {
        $filename = $_FILES['file']['name'];
        $TMP_name = $_FILES['file']['tmp_name'];
        $sql = "update category set name= '".$_POST['category_name']."',parent_id='".$_POST['cat']."',image = '".$filename."' where id = '".$_POST['cat_id']."'";
        $folder='sub_cat_image/';
        $var=move_uploaded_file($TMP_name,$folder.$filename);
    }else{
        $sql = "update category set name= '".$_POST['category_name']."',parent_id='".$_POST['cat']."' where id = '" . $_POST['cat_id'] . "'";
    }
    $query = mysqli_query($con,$sql);
    if($query)
    {
        $_SESSION['success'] = "Data updated Successfully";
        header('location:managesubcat.php');
    }else{
        $_SESSION['error'] = "unable to update".mysqli_error($con);
        header('location:managesubcat.php');
    }

}
else{
    $_SESSION['error'] = "unable to update" . mysqli_error($con);
    header('location:managesubcat.php');

}
