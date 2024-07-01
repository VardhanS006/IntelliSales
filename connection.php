<?php

// to use file in another program
// include - if there is error in a line, it shows tht error nd runs the rest of the code
// require - if there is error in a line, it shows tht error nd doesnt run the rest of the code

$localhost = "127.0.0.1:3307";
$user = "root";
$password = "";
// $con = mysqli_connect($localhost,$user,$password);//4 parameters - 4th one is for the database name, if there is no thn it connects with the server.......Return true if success else false.
$database = "superkartsoft_superkart_db";
$con = mysqli_connect($localhost,$user,$password,$database);

?>