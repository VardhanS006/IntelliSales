<?php
include "connection.php";
session_start();
if (isset($_GET['delete'])) {
    $deleteId = base64_decode($_GET['delete']);
    $deleteSql = "DELETE FROM category WHERE id = $deleteId";
    if (mysqli_query($con, $deleteSql)) {
        $_SESSION['success'] = "Category deleted successfully";
        header("Location: managesubcat.php");
    } else {
        $_SESSION['error'] = "Failed to delete category";
        header("Location: managesubcat.php");
    }
}
?>