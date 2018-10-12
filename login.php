<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password){

    $connect = mysqli_connect("localhost","root","") or die ("couldn't connect");
    mysqli_select_db($connect,"phplogin") or die("couldn't find db");

    $query = mysqli_query($connect," SELECT * FROM users WHERE username='$username'");

    $numrows = mysqli_num_rows($query);

    if ($numrows!=0){
//code to login
        while ($row = mysqli_fetch_assoc($query)){

            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            // $activated = $row['activated'];

            // if ($activated == '0'){
            //     die("your account is not active. please check your email");
            //     exit();
            // }
        }
        //check to see if they match


        if ($username==$dbusername && ($password)==$dbpassword) //md5 is deleted from here
         {
            echo "you'r in!! <a href='member.php'>Click here</a> to enter member page";

            $_SESSION['username']=$dbusername;
        }
        else
            echo "incorrect";
    }
    else
        echo "that user doesn't exist";

}
else
    die("please enter a username and password");
