<?php

session_start();

$user = $_SESSION['username'];

if ($user){

    //user is logged in
    if (isset($_POST['submit'])){
        //start changing password
        //check fields
        $oldpassword = md5($_POST['oldpassword']);
        $newpassword = md5($_POST['newpassword']);
        $repeatnewpassword = md5($_POST['repeatnewpassword']);

        //check password against db

        //connect db
        $connect = mysqli_connect("localhost","root","") or die("query don't work");
        mysqli_select_db($connect,"phplogin") or die("query don't work");

        $queryget = mysqli_query($connect,"SELECT password FROM users WHERE username = '$user'") or die("query don't work");

        $row = mysqli_fetch_assoc($queryget);

        $oldpassworddb = $row['password'];
        echo $oldpassworddb;



        //check password

        if ($oldpassword == $oldpassworddb) {

            //check two passwords
            if ($newpassword == $repeatnewpassword) {

                //success
                // change password in db

                $querychange = mysqli_query($connect, "
                UPDATE users SET password = '$newpassword' 
                WHERE username = '$user'
                
                ");
                session_destroy();

                die("you'r password has been changed. <a href='index.php'>return</a> ");


            } else
                die("new passwords don't match");
        }
        else
            die("old password doesn't match");

    }
    else{

    echo"
    
    <form action='changepassword.php' method='POST'>
    
    old password : <input type='text' name='oldpassword'><br>
    new password : <input type='password' name='newpassword'><br>
    reapeat new password : <input type='password' name='repeatnewpassword'><br>
    <input type='submit' name='submit' value='change password'>
    
    
</form>
    
    ";
    }

}
else
    die("you must log in to change password");