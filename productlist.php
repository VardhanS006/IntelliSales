<?php
include 'connection.php';

if (isset($_POST['sub_id'])) {
    $sql = "select * from product where sub_category = ".$_POST['sub_id']." AND status='enabled'";
    $query = mysqli_query($con, $sql);
    
    $tbcntnt = '<div><div class="page-header"><div class="page-title"><h4>Products</h4></div></div><div class="row ">';

    while ($data = mysqli_fetch_assoc($query)) {
        $sql2 = "select * from brand where id = ".$data['brand'];
        $query2 = mysqli_query($con, $sql2);
        $data2 = mysqli_fetch_assoc($query2);
        
        $act='add';
        $tbcntnt=$tbcntnt.'<div class="col-lg-3 col-sm-6 d-flex "><div class="productset flex-fill active"><div class="productsetimg"><img src="product_images/'.$data['image'].'" style="padding:15px;max-height:150px;min-height:150px" alt="img"><h6>Stock: '.$data['stock'].'</h6><div class="check-product"><i class="fa fa-check"></i></div></div><div class="productsetcontent"><h5>'.$data2['name'].'</h5><h5>'.$_POST['sub_name'].'</h5><div style="height:46px;overflow:hidden" class="mb-2"><h4>'.$data['name'].'</h4></div><h6>Rs.'.$data['selling_price'].'</h6><button class="btn btn-primary" onclick="procart('.$data['product_id'].',1)">Add to Cart</button></div></div></div>';
    }

    $tbcntnt.='</div></div>';

    if(mysqli_num_rows($query)>=1){
        echo $tbcntnt;
    }
    else{
        echo '1';
    }

}

?>