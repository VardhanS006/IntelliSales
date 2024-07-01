<?php
include 'connection.php';

if (isset($_POST['cate'])) {
    $sql = "select * from category where parent_id = '".$_POST['cate']."'";
    $query = mysqli_query($con, $sql);
    $sub_cate = '<option value="">Select Sub-Category</option>';
    while ($data = mysqli_fetch_assoc($query)) {
        $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
    }
    echo $sub_cate;
}
elseif (isset($_POST['subcate'])) {
    $sql = "select * from brand where parent_id = '".$_POST['subcate']."'";
    $query = mysqli_query($con, $sql);
    $brnd = '<option value="">Select Brand</option>';
    while ($data = mysqli_fetch_assoc($query)) {
        $brnd .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
    }
    echo $brnd;
}
elseif (isset($_POST['brnd'])) {
    $sql = "select * from product where brand = '".$_POST['brnd']."'";
    $query = mysqli_query($con, $sql);
    $prdt = '<option value="">Select Product</option>';
    while ($data = mysqli_fetch_assoc($query)) {
        $prdt .= "<option value='" . $data['product_id'] . "'>" . $data['name'] . "</option>";
    }
    echo $prdt;
}
elseif (isset($_POST['prdct'])) {
    $sql = "select * from product where product_id = '".$_POST['prdct']."'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $prdt = '<input type="number" class="cost text-right" name="cst[]" id="cst'.$_POST['rowid'].'" onchange="checkcat(this,'.$_POST['rowid'].')" value="'.$data['cost_price'].'">';
    echo $prdt;
}

?>


