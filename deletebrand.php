<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "DELETE FROM brand WHERE id = $deleteId";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['success'] = "Brand deleted successfully";
        header("Location: brand.php");
    } else {
        $_SESSION['error'] = "Failed to delete brand";
        header("Location: brand.php");
    }
}
?>