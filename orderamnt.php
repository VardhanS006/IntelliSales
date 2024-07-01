<?php

include 'razorpay/Razorpay.php';
include 'connection.php';

use Razorpay\Api\Api;

if (isset($_POST['ctotal'])) {
    $api = new Api('rzp_test_XfeLoTpf1EOOLE','1JRzkPvFaY0j9i98OwOub2pR');

    $receipt_id = 'IS_sprkrt_' . $_POST['t_id'];

    $order = $api->order->create([
        'receipt' => $receipt_id,
        'amount' => intval($_POST['ctotal']) * 100,
        'currency' => 'INR',
    ]);

    $sql = "select * from customer where name = '".$_POST['cstid']."'";
    $query = mysqli_query($con,$sql);
    $cst = mysqli_fetch_assoc($query);

    $response = $order->amount . ',' . $order->id . ',' . $cst['phone'];

    echo $response;
}
else{
    header('location:pos.php');
}
?>