<?php
include 'connection.php';

if (isset($_POST['brand'])) {
    $sql = "select * from brand where name = '".$_POST['brand']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}
if (isset($_POST['product'])) {
    $sql = "select * from product where name = '".$_POST['product']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}
if (isset($_POST['sub_cat'])) {
    $sql = "select * from category where name = '".$_POST['sub_cat']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}
if (isset($_POST['category'])) {
    $sql = "select * from category where name = '".$_POST['category']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}

if (isset($_POST['customer'])) {
    $sql = "select * from customer where name = '".$_POST['customer']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}

if (isset($_POST['supplier'])) {
    $sql = "select * from supplier where name = '".$_POST['supplier']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}

if (isset($_POST['warehouse'])) {
    $sql = "select * from warehouse where name = '".$_POST['warehouse']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}



?>