<?php
include 'connection.php';
session_start();

if(isset($_POST['submit'])){  

    $dt = date("Y/m/d");
    $cust = $_POST['cstname'];
    $ttlamnt = $_POST['ctotal'];
    $pmode = $_POST['p_mode'];
    $userid = $_SESSION['userid'];

    $cstid=$_POST['cstid'];

    $sql="insert into sale(user_id,date,customer,payment_mode,amount) values('".$userid."','".$dt."','".$cstid."','".$pmode."','".$ttlamnt."')";
    $query=mysqli_query($con,$sql);
    
    

    if($query){

        $sql1="select * from cart where customer=".$cstid." AND user_id=".$userid;
        $query1=mysqli_query($con,$sql1);

        $sale_id = $_POST['t_id'];

        while($data1 = mysqli_fetch_assoc($query1)){
            if($data1['quantity']>0){
                $prdct = $data1['product'];
                $qty = $data1['quantity'];
                $ttlprice = $data1['total_price'];

                $sql6="select * from product where product_id=".$prdct;
                $query6=mysqli_query($con,$sql6);
                $dat6=mysqli_fetch_assoc($query6);

                $img = $dat6['image'];

                $sql2 = "insert into sale_items(sale_id,product,quantity,total_price,image) value('".$sale_id."','".$prdct."','".$qty."','".$ttlprice."','".$img."')";
                $query2=mysqli_query($con,$sql2);

                $sql3="update product set stock=stock-".$qty." where product_id=".$prdct;
                $query3=mysqli_query($con,$sql3);
                if($query3)
                {
                    continue;
                }
                else{
                    $_SESSION['error']="Some Error Occurred!";
                    header('location:pos.php');
                    break;
                }
            }
        }

        $sql4 = "delete from cart where customer=".$cstid." AND user_id=".$userid;
        $query4 = mysqli_query($con, $sql4);
        if($query4){
            $_SESSION['success']="Purchase Was Successful";
             $_SESSION['redirected']="0";
            header('location:receipt.php?sale_id='.base64_encode($sale_id));
        }
        else{
            $_SESSION['error']="Some Error Occurred   1!";
            header('location:pos.php');
        }
    }
    else{
        $_SESSION['error']="Some Error Occurred!";
        header('location:pos.php');
    }
}
?>