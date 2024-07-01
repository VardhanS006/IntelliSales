<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "DELETE FROM supplier WHERE id = $deleteId";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['success'] = "Supplier deleted successfully";
        header("Location: supplier.php");
    } else {
        $_SESSION['error'] = "Failed to delete Supplier";
        header("Location: supplier.php");
    }
}
?>
