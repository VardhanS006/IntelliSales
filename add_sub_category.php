<?php
session_start();
include 'connection.php';

if (isset($_POST['submit']) && !empty($_FILES['file']['name'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $sql = "insert into category(name,image,parent_id) values('" . $_POST['category_name'] . "','" . $file_name . "','" . $_POST['cate_id'] . "')";
    $query = mysqli_query($con, $sql);
    if ($query) {
        $folder = 'sub_cat_image/';
        $var =  move_uploaded_file($file_tmp_name, $folder . $file_name);
        $_SESSION['success'] = "Data Added Successfully";
        header('location:adsubcat.php');
    } else {
        $_SESSION['error'] = "Something Went wrong";
        header('location:adsubcat.php');
    }
} else {
    $_SESSION['error'] = "Please choose file and category name";
    header('location:adsubcat.php');
}
