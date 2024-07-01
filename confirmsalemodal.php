<?php
include 'connection.php';
session_start();

if(isset($_POST['cust'])){  

    $dt = date("Y/m/d");
    $cust = $_POST['cust'];
    $ttlamnt = $_POST['ctotal'];
    $pmode = $_POST['pmode'];
    $t_id = $_POST['t_id'];
    $t_items = $_POST['t_itm'];
    $userid = $_SESSION['userid'];

    $sql="select * from customer where id=".$cust;
    $query=mysqli_query($con,$sql);
    $dat=mysqli_fetch_assoc($query);

    $cstname = $dat['name'];

    $sql="select * from users where user_id=".$userid;
    $query=mysqli_query($con,$sql);
    $dat=mysqli_fetch_assoc($query);

    $username = $dat['name'];

    $saleform='<div class="form-group row"><div class="col-lg-4 col-md-4 col-sm-12"><label>Transaction id:</label><input readonly class="form-control m-0 p-0" id="t_id" name="t_id" style="border:none;background:transparent" value="'.$t_id.'"></div><div class="col-lg-8 col-md-8 col-sm-12"><label>Customer:</label><input readonly class="form-control m-0 p-0" id="cstname" name="cstname" style="border:none;background:transparent" value="'.$cstname.'"><input readonly type="hidden" class="form-control" name="cstid" value="'.$cust.'"></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Details:</label><input readonly class="form-control m-0 p-0" id="t_items" name="t_items" style="border:none;background:transparent" value="'.$t_items.'"></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Payment Mode:</label><input readonly class="form-control m-0 p-0" id="p_mode" name="p_mode" style="border:none;background:transparent" value="'.$pmode.'"></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Amount:</label><input readonly class="form-control m-0 p-0" id="ctotal" name="ctotal" style="border:none;background:transparent" value="'.$ttlamnt.'"></div></div><div class="row p-2"><table class="table table-bordered mt-4 mb-2 text-center text-bold" overflow-y:scroll><thead class="bg-dark text-light"><tr><td>Image</td><td>Product Name</td><td>Quantity</td><td>Price</td><td>Amount</td></tr></thead><tbody>';

    $sql1="select * from cart where customer=".$cust." AND user_id=".$userid;
    $query1=mysqli_query($con,$sql1);

    while($data1 = mysqli_fetch_assoc($query1)){
        if($data1['quantity']>0){

            $img = $data1['image'];
            $prdct = $data1['product'];
            $qty = $data1['quantity'];
            $price = $data1['price'];
            $ttlprice = $data1['total_price'];

            $sql="select * from product where product_id=".$prdct;
            $query=mysqli_query($con,$sql);
            $dat=mysqli_fetch_assoc($query);

            $pdtname = $dat['name'];

            $saleform .= '<tr><th><img src="product_images/'.$img.'" style="width:30px;height:30px"></th><th>'.$pdtname.'</th><th>'.$qty.'</th><th>'.$price.'</th><th>'.$ttlprice.'</th></tr>';
        }
    }

    $saleform .= '<tr><th colspan="3"></th><th class="bg-dark text-light">Total</th><th class="bg-dark text-light">'.$ttlamnt.'</th></tr></tbody></table></div>';
    echo $saleform;
}
?>