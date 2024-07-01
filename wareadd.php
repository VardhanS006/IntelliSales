<?php
include 'connection.php';

if (isset($_POST['ware'])) {
    $sql = "select * from warehouse where id = '".$_POST['ware']."'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    echo $data['address'];
}

?>