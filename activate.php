<?php

$connect = mysqli_connect("localhost","root","");
mysqli_select_db($connect,"phplogin");
$id = $_GET['id'];
$code = $_GET['code'];

if ($id&&$code){

    $check = mysqli_query($connect,"SELECT FROM users WHERE id ='$id' AND random='$code'");
    $checknum = mysqli_num_rows($check);

    if ($checknum == 1){
        //query to activate

        $acti = mysqli_query($connect,"UPDATE dusers SET activated ='1' WHERE id = '$id'");
        die("You'r account is activated");
    }
    else
        die("Invalid id or activation code. you may be logged in!");

}
else
    die("Data Missing!!");