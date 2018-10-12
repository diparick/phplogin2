<?php

session_start();

if ($_SESSION['username'])

echo "Hi!! Welcome " .$_SESSION['username'] . "!! <br> <a href='logout.php'>logout</a> <br> <a href='changepassword.php'>change password</a>" ;

else
    die("you must be logged in!!");