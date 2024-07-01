<?php
include 'connection.php';
session_start();

if(isset($_POST['cnfrm'])){
    if(!empty($_POST['ttlqty']) && !empty($_POST['ttlamtcheck']))
    {   
        
        $p_id = $_POST['p_no'];
        $dt = $_POST['pdate'];
        $sup = $_POST['sup'];
        $ware = $_POST['ware'];
        $ttlamnt = $_POST['totlamt'];

        $prdt = $_POST['prdct'];
        $qnty = $_POST['qty'];
        $cst = $_POST['cst'];
        $eachttl = $_POST['ttl'];
        
        $sql2="insert into purchase(date,supplier,warehouse,amount) values('".$dt."','".$sup."','".$ware."','".$ttlamnt."')";
        $query2=mysqli_query($con,$sql2);
        if($query2){
            for($i=0;$i<count($_POST['cat']);$i++){
                    
                if($qnty[$i]){
                    
                    $qty = $qnty[$i];
                    $cost = $cst[$i];
                    $pt_id = $prdt[$i];
                    $amnt = $eachttl[$i];
                    
                    $sql1="insert into purchase_items(id,product,quantity,cost,total_amount) values('".$p_id."','".$pt_id."','".$qty."','".$cost."','".$amnt."')";
                    $query1=mysqli_query($con,$sql1);

                    $sql="update product set stock=stock+".$qty.", cost_price=".$cost." where product_id=".$pt_id;
                    $query=mysqli_query($con,$sql);
                    if($query)
                    {
                        continue;
                    }
                    else{
                        $_SESSION['error']="Some Error Occurred!";
                        header('location:purchase.php');
                        break;
                    }
                }
                else{
                    continue;
                }
            }
        
            $_SESSION['success']="Purchase Added Successfully.";
            header('location:purchase.php');
        }
        else{
            $_SESSION['error']="Some Error Occurred!!!";
            header('location:purchase.php');
        }
    }
    else{
        $_SESSION['error']="No data entered!!!";
        header('location:purchase.php');
    }
}
?>