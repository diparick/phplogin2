<?php

     error_reporting(0);

    echo "<h1>Register</h1>";   
    $submit = $_POST['submit'];
    $fullname = strip_tags($_POST['fullname']);
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $repeatpassword = strip_tags($_POST['repeatpassword']);
    $date = date("Y-m-d");



if (isset($submit)){
    //open database
    $connect = mysqli_connect("localhost","root","");
    mysqli_select_db($connect,"phplogin");//select database

    $namecheck = mysqli_query($connect,"SELECT username FROM users WHERE username = '$username'");
    $count = mysqli_num_rows($namecheck);

    if ($count !=0){

        die ("Username already taken!");

    }

        //check for existance
    if ($fullname&&$username&&$password&&$repeatpassword){


        if ($password == $repeatpassword){

            //check char length of username and fullname
            if (strlen($username)>25||strlen($fullname)>25){
                echo "max limit for username and fullname are 25 characters";


            }
            else{

                //check password length
                if (strlen($password)>25||strlen($password)<6){
                    echo"password must be between 6 and 25 characters";

                }
                else{

                    //register the user

                    //encrypt password
                    $password = md5($password);
                    $repeatpassword = md5($repeatpassword);

                    //generate random number for activation process
                    $random = rand(23456789,98765432);

                    $queryreg = mysqli_query($connect,"INSERT INTO users VALUES ('','$fullname','$username','$password','$email','$date','$random','0')");

                    die ("you've been registered <a href='index.php'>Return to login page</a>");

                }

            }
        }
        else
            echo"you'r password do not match";

    }
    else
        echo "please fill <b>all</b> the field";

}






?>
<html>



<form action="register.php" method="POST">

    <table>

        <tr>

            <td>your full name : </td>
            <td>
                <input type="text" name = 'fullname' value="<?php echo $fullname;?>">
            </td>

        </tr>

        <tr>
        <td> choose a username : </td>
        <td>
            <input type="text" name = 'username' value="<?php echo $username;?>">
        </td>

        </tr>



        <tr>
        <td>choose a password : </td>
        <td>
            <input type="password" name = 'password'>
        </td>

        </tr>


        <tr>
        <td>repeat password : </td>
        <td>
            <input type="password" name = 'repeatpassword'>
        </td>

        </tr>

        <tr>
            <td>email : </td>
            <td>
                <input type="text" name = 'email'>
            </td>

        </tr>

        <tr>
        <td>
            <input type="submit" name = 'submit' value="Register">
        </td>

        </tr>

    </table>

</form>
</html>
