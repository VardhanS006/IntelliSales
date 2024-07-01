<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "DELETE FROM warehouse WHERE id = $deleteId";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['msg'] = "warehouse deleted successfully";
        header("Location: warehouse.php");
    } else {
        $_SESSION['error'] = "Failed to delete warehouse";
        header("Location: warehouse.php");
    }
}
?>
