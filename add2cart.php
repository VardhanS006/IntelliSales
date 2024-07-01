<?php
include 'connection.php';
session_start();
if (isset($_POST['proid'])) {
    $sql = "select * from cart where product = ".$_POST['proid']." AND customer=".$_POST['cust']." AND user_id=".$_SESSION['userid'];
    $query = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($query)==0){
        
        $cust = $_POST['cust'];
        $product = $_POST['proid'];

        $sql2 = "select * from product where product_id = ".$_POST['proid'];
        $query2 = mysqli_query($con, $sql2);
        $data2 = mysqli_fetch_assoc($query2);

        $procode = $data2['product_code'];
        $price = $data2['selling_price'];
        $ttlamnt = $price;
        
        $proimg = $data2['image'];

        $sql3 = "insert into cart(customer,product,product_code,price,quantity,total_price,image,user_id) values('".$cust."','".$product."','".$procode."','".$price."','1','".$ttlamnt."','".$proimg."','".$_SESSION['userid']."')";
        $query3 = mysqli_query($con, $sql3);

        $sql = "select * from cart where customer=".$_POST['cust']." AND user_id=".$_SESSION['userid'];
        $query = mysqli_query($con, $sql);
        $dataa='';

        while ($data = mysqli_fetch_assoc($query)) {

            $sql1 = "select * from product where product_id=".$data['product'];
            $query1 = mysqli_query($con, $sql1);
            $data1 = mysqli_fetch_assoc($query1);
            // <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><imgsrc="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/edit-5.svg" alt="img"></a>
            $dataa .= '<ul class="product-lists" style="position:relative"><li id="pric'.$data['product'].'" hidden>'.$data['price'].'</li><li><div class="productimg"><div class="productimgs"><img src="product_images/'.$data['image'].'" alt="img"></div><div class="productcontet"><h4 style="justify-content:flex-start">'.$data1['name'].'</h4><div class="productlinkset"><h5>'.$data['product_code'].'</h5></div><div class="increment-decrement"><div class="input-groups"><input type="button" value="-" class="button-minus button" onclick="procart('.$data['product'].',-1)"><input type="text" name="child" value="'.$data['quantity'].'" class="quantity-field" id="qty'.$data['product'].'" readonly><input type="button" value="+"class="button-plus button" onclick="procart('.$data['product'].',1)"></div></div></div></div></li><li id="ttl'.$data['product'].'" style="position:absolute;left:270px;top:45px">'.$data['total_price'].'</li><li><a class="confirm-text" href="javascript:void(0);" onclick="delcart('.$data['product'].')"><img src="icons/trash-can-solid.svg" alt="img"></a></li></ul>';
        }

        echo $dataa;
    }
    else{
        if($_POST['act']==1){
            $sql2 = "update cart set quantity=quantity+1,total_price=price*quantity where product=".$_POST['proid']." AND user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
            $query2 = mysqli_query($con, $sql2);
            echo 'increase';
        }
        else if($_POST['act']==-1){
            $sql3 = "select quantity from cart where product=".$_POST['proid'];
            $query3 = mysqli_query($con, $sql3);
            $datachck = mysqli_fetch_assoc($query3);
            if($datachck['quantity']>0){
                $sql2 = "update cart set quantity=quantity-1,total_price=price*quantity where product=".$_POST['proid']." AND user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
                $query2 = mysqli_query($con, $sql2);
            }
            echo 'decrease';
        }
    }

}
if(isset($_POST['cust'])&&!isset($_POST['proid'])){
    $sql = "select * from cart where user_id=".$_SESSION['userid']." AND customer=".$_POST['cust'];
    $query = mysqli_query($con, $sql);
    $dataa='';

    while ($data = mysqli_fetch_assoc($query)) {

        $sql1 = "select * from product where product_id=".$data['product'];
        $query1 = mysqli_query($con, $sql1);
        $data1 = mysqli_fetch_assoc($query1);

        $dataa .= '<ul class="product-lists" style="position:relative"><li id="pric'.$data['product'].'" hidden>'.$data['price'].'</li><li><div class="productimg"><div class="productimgs"><img src="product_images/'.$data['image'].'" alt="img"></div><div class="productcontet"><h4 style="justify-content:flex-start">'.$data1['name'].'</h4><div class="productlinkset"><h5>'.$data['product_code'].'</h5></div><div class="increment-decrement"><div class="input-groups"><input type="button" value="-" class="button-minus button" onclick="procart('.$data['product'].',-1)"><input type="text" name="child" value="'.$data['quantity'].'" class="quantity-field" id="qty'.$data['product'].'" readonly><input type="button" value="+"class="button-plus button" onclick="procart('.$data['product'].',1)"></div></div></div></div></li><li id="ttl'.$data['product'].'" style="position:absolute;left:270px;top:45px">'.$data['total_price'].'</li><li><a class="confirm-text" href="javascript:void(0);" onclick="delcart('.$data['product'].')"><img src="icons/trash-can-solid.svg" alt="img"></a></li></ul>';
    }

    echo $dataa;
}

?>