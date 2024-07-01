<?php
ob_start();
session_start();
include 'connection.php';
if(isset($_POST['signin'])){
    $sql = "select * from users where email = '".$_POST['email']."'";
    $query = mysqli_query($con,$sql);
    $fetchdata = mysqli_fetch_assoc($query);
    // print_r($fetchdata);
    if(mysqli_num_rows($query)==1){
        if (password_verify($_POST['pass'],$fetchdata['password'])){
            $_SESSION['success'] = 'Login Successful.';
            $_SESSION['login'] = $fetchdata['name'];
            
            $_SESSION['userid'] = $fetchdata['user_id'];
            $_SESSION['img'] = $fetchdata['image'];
            if($fetchdata['role']=='1'){
                $_SESSION['role'] = '1';
                
                header('location:dashboard.php');
            }
            else{
                $_SESSION['role'] = '2';
                header('location:pos.php');
            }
        }
        else{
            $_SESSION['error'] = 'Invalid Password!!!';
            header('location:index.php');
        }
    }
    else{
        $_SESSION['error'] = 'Email Address not Registered';
        header('location:index.php');
    }
}
else{
    echo 'error';
}

ob_end_flush();
?>