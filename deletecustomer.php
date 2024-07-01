<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "DELETE FROM customer WHERE id = $deleteId";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['success'] = "Category deleted successfully";
        header("Location: customer.php");
    } else {
        $_SESSION['error'] = "Failed to delete category";
        header("Location: customer.php");
    }
}
?>
