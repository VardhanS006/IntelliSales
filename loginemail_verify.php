<?php
include 'connection.php';

if (isset($_POST['email'])) {
    $sql = "select * from users where email = '".$_POST['email']."'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query)>=1){
        echo '1';
    }
    else{
        echo '2';
    }
}


?>