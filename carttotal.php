<?php
include 'connection.php';
session_start();
if (isset($_POST['cust'])) {
    if($_POST['cust']!=""){
        $sql = "select sum(total_price) as carttotal from cart where user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
        $query = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($query);

        echo $data['carttotal'];
    }
    else{
        echo "";
    }
}

?>