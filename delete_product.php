<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "update product set status='disabled'where product_id='".$deleteId."'";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['success'] = "product deleted successfully";
        header("Location: productdetail.php");
    } else {
        $_SESSION['error'] = "Failed to delete product";
        header("Location: ptoductdetail.php");
    }
}
else{
    echo "error";
}
?>
