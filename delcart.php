<?php
include 'connection.php';
session_start();
if (isset($_POST['cust'])&&!isset($_POST['proid'])) {
    $sql = "delete from cart where user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
    $query = mysqli_query($con, $sql);
    echo 'all';
}
if(isset($_POST['proid'])){
    $sql = "delete from cart where product=".$_POST['proid']." AND user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
    $query = mysqli_query($con, $sql);

    $sql = "select * from cart where user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
    $query = mysqli_query($con, $sql);
    $dataa='';

    while ($data = mysqli_fetch_assoc($query)) {

        $sql1 = "select * from product where product_id=".$data['product'];
        $query1 = mysqli_query($con, $sql1);
        $data1 = mysqli_fetch_assoc($query1);

        $dataa .= '<ul class="product-lists"><li id="pric'.$data['product'].'" hidden>'.$data['price'].'</li><li><div class="productimg"><div class="productimgs"><img src="product_images/'.$data['image'].'" alt="img"></div><div class="productcontet"><h4>'.$data1['name'].'<a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><imgsrc="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/edit-5.svg" alt="img"></a></h4><div class="productlinkset"><h5>'.$data['product_code'].'</h5></div><div class="increment-decrement"><div class="input-groups"><input type="button" value="-" class="button-minus button" onclick="procart('.$data['product'].',-1)"><input type="text" name="child" value="'.$data['quantity'].'" class="quantity-field" id="qty'.$data['product'].'"><input type="button" value="+"class="button-plus button" onclick="procart('.$data['product'].',1)"></div></div></div></div></li><li id="ttl'.$data['product'].'">'.$data['total_price'].'</li><li><a class="confirm-text" href="javascript:void(0);" onclick="delcart('.$data['product'].')"><img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/delete-2.svg" alt="img"></a></li></ul>';
    }

    echo $dataa;
}

?>