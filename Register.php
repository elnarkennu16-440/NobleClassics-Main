<?php

include 'Config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `register` WHERE email='$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User Already Exists!';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Confirm Password Not Matched!';
        } else {
            if ($user_type == 'admin') {
                // Check if an admin already exists
                $check_admin = mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='admin'") or die('query failed');
                if (mysqli_num_rows($check_admin) > 0) {
                    $message[] = 'Administrator Account Already Exists!';
                } else {
                    mysqli_query($conn, "INSERT INTO `register`(name, email, password, user_type) VALUES('$name', '$email', '$cpassword', '$user_type')") or die('query failed');
                    $message[] = 'Administrator Registered Successfully!';
                    header('location:Login.php');
                }
            } else {
                mysqli_query($conn, "INSERT INTO `register`(name, email, password, user_type) VALUES('$name', '$email', '$cpassword', '$user_type')") or die('query failed');
                $message[] = 'Registered Successfully!';
                header('location:Login.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOBLECLASSICS - REGISTER ACCOUNT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="Login.css">

    <style>
        .message {
            background-color: #33230f;
            border: 1px solid rgb(224, 159, 85);
            color: rgb(236, 174, 93);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 40px !important;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .message i {
            cursor: pointer;
            margin-left: 10px;
        }
    </style>

</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
        </div>
    ';
        }
    }
    ?>

    <div class="box">
        <span class="borderline"></span>
        <form action="" method="post">
            <h2>Create Your Account</h2>
            <div class="inputbox">
                <input type="text" name="name" required="required">
                <span>Full Name</span>
                <i></i>
            </div>

            <div class="inputbox">
                <input type="email" name="email" required="required">
                <span>Email</span>
                <i></i>
            </div>

            <div class="inputbox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>

            <div class="inputbox">
                <input type="password" name="cpassword" required="required">
                <span>Confirm Password</span>
                <i></i>
            </div>

            <div class="inputbox">
                <select name="user_type">
                    <option value="user">Customer</option>
                    <option value="admin">Administrator</option>
                </select>
                <i></i>
            </div>


            <div class="links">
                <a href="ForgotPassword.php">Forgot Password?</a>
                <a href="Login.php">Login Account</a>
            </div>


            <input type="submit" value="Register Now" name="submit">

        </form>

    </div>

    <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
</body>

</html>