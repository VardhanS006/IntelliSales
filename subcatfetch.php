<?php
include 'connection.php';

if (isset($_POST['cate'])) {
    $sql = "select * from category where parent_id = '".$_POST['cate']."'";
    $query = mysqli_query($con, $sql);
    $sub_cate = '<option value="">Choose Sub-Category</option>';
    while ($data = mysqli_fetch_assoc($query)) {
        $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
    }
    echo $sub_cate;
}
if (isset($_POST['subcate'])) {
    $sql = "select * from brand where parent_id = '".$_POST['subcate']."'";
    $query = mysqli_query($con, $sql);
    $sub_cate = '<option value="">Choose Brand</option>';
    while ($data = mysqli_fetch_assoc($query)) {
        $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
    }
    echo $sub_cate;
}

?>


