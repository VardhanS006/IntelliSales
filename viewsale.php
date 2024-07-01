<?php
include 'connection.php';
session_start();

if(isset($_POST['cust'])){  

    $dt = date("Y/m/d");
    $cust = $_POST['cust'];
    $ttlamnt = $_POST['ctotal'];
    $pmode = $_POST['pmode'];
    $pstatus = $_POST['pstatus'];
    $t_id = $_POST['t_id'];
    $userid = $_SESSION['userid'];

    $sql="select * from customer where id=".$cust;
    $query=mysqli_query($con,$sql);
    $dat=mysqli_fetch_assoc($query);

    $cstname = $dat['name'];

    $sql="select * from users where user_id=".$userid;
    $query=mysqli_query($con,$sql);
    $dat=mysqli_fetch_assoc($query);

    $username = $dat['name'];

    $sql1="select * from sale_items where sale_id=".$t_id;
    $query1=mysqli_query($con,$sql1);

    $t_items = mysqli_num_rows($query1);

    $saleform='<div class="form-group row"><div class="col-lg-4 col-md-4 col-sm-12"><label>Transaction id:</label><input class="form-control m-0 p-0" id="t_id" name="t_id" style="border:none;background:transparent" value="#'.$t_id.'" readonly></div><div class="col-lg-4 col-md-4 col-sm-12"><label>Customer:</label><input class="form-control m-0 p-0" id="cstname" name="cstname" style="border:none;background:transparent" value="'.$cstname.'" readonly><input type="hidden" class="form-control" name="cstid" value="'.$cust.'" readonly></div><div class="col-lg-4 col-md-4 col-sm-12"><label>Total Items:</label><input class="form-control" id="t_items" name="t_items" style="border:none;background:transparent" value="'.$t_items.'" readonly></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Payment Mode:</label><input class="form-control m-0 p-0" id="p_mode" name="p_mode" style="border:none;background:transparent" value="'.$pmode.'" readonly></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Payment Status:</label><input class="form-control m-0 p-0" id="p_mode" name="p_mode" style="border:none;background:transparent" value="'.$pstatus.'" readonly></div><div class="col-lg-4 col-md-4 col-sm-12 mt-3"><label>Amount:</label><input class="form-control m-0 p-0" id="ctotal" name="ctotal" style="border:none;background:transparent" value="'.$ttlamnt.'" readonly></div></div><div class="row"><table class="table table-bordered mt-4 mb-4 text-center text-bold" overflow-y:scroll><thead class="bg-dark text-light"><tr><td>Image</td><td>Product Name</td><td>Quantity</td><td>Price</td><td>Amount</td></tr></thead><tbody>';

    while($data1 = mysqli_fetch_assoc($query1)){
        if($data1['quantity']>0){

            $img = $data1['image'];
            $prdct = $data1['product'];
            $qty = $data1['quantity'];
            $ttlprice = $data1['total_price'];

            $sql="select * from product where product_id=".$prdct;
            $query=mysqli_query($con,$sql);
            $dat=mysqli_fetch_assoc($query);

            $pdtname = $dat['name'];
            $price = $ttlprice/$qty;

            $saleform .= '<tr><th><img src="product_images/'.$img.'" style="width:30px;height:30px"></th><th>'.$pdtname.'</th><th>'.$qty.'</th><th>'.$price.'</th><th>'.$ttlprice.'</th></tr>';
        }
    }

    $saleform .= '<tr><th colspan="3"></th><th class="bg-dark text-light">Total</th><th class="bg-dark text-light">'.$ttlamnt.'</th></tr></tbody></table></div><div class="modal-footer"><button type="button" class="btn btn-secondary form-control" data-dismiss="modal" data-bs-dismiss="modal">Close</button></div>';
    echo $saleform;
}
?>