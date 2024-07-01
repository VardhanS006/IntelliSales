<?php

session_start();
include 'connection.php';
if(isset($_POST['signup'])){
    $pass = password_hash($_POST['re_pass'],PASSWORD_BCRYPT);
    $file_name = $_FILES['img']['name'];
    $file_tmp_name = $_FILES['img']['tmp_name'];
    $sql1 = "select * from users where role=1";
    $query1 = mysqli_query($con,$sql1);
    if(mysqli_num_rows($query1)==0){
        $sql = "insert into users(name,email,phone,image,password,role) values('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$file_name."','".$pass."','1')";
        $query = mysqli_query($con,$sql);
        if($query){
            $folder = 'admin_img/';
            $var =  move_uploaded_file($file_tmp_name,$folder.$file_name);
            $_SESSION['success'] = 'Admin Created Successfully.';
            header('location:index.php');
        }
        else{
            $_SESSION['error'] = 'Data Insertion Failed!!!';
            header('location:regform.php');
        }
    }
    else{
        $sql = "insert into users(name,email,phone,image,password) values('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$file_name."','".$pass."')";
        $query = mysqli_query($con,$sql);
        if($query){
            $folder = 'user_img/';
            $var =  move_uploaded_file($file_tmp_name,$folder.$file_name);
            $_SESSION['success'] = 'User Created Successfully.';
            header('location:index.php');
        }
        else{
            $_SESSION['error'] = 'Data Insertion Failed!!!';
            header('location:regform.php');
        }
    }
}


?>