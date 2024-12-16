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
        $message[] = 'User already exists!';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Confirm password not matched!';
        } else {
            if ($user_type == 'admin') {
                // Check if an admin already exists
                $check_admin = mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='admin'") or die('query failed');
                if (mysqli_num_rows($check_admin) > 0) {
                    $message[] = 'Administrator account already exists!';
                } else {
                    mysqli_query($conn, "INSERT INTO `register`(name, email, password, user_type) VALUES('$name', '$email', '$cpassword', '$user_type')") or die('query failed');
                    $message[] = 'Administrator registered successfully!';
                    header('location:Login.php');
                }
            } else {
                mysqli_query($conn, "INSERT INTO `register`(name, email, password, user_type) VALUES('$name', '$email', '$cpassword', '$user_type')") or die('query failed');
                $message[] = 'Registered successfully!';
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
            background-color: #2b1f0e;
            border: 1px solid #f5c389;
            color:rgb(244, 188, 115);
            padding: 12px 15px;
            /* Adjusted padding for better balance */
            margin: 10px auto;
            border-radius: 5px;
            font-size: 18px;
            font-family: Arial, sans-serif;
            text-align: center;
            display: inline-flex;
            /* Ensures better alignment with text and icons */
            align-items: center;
            /* Centers content vertically */
            max-width: 90%;
            box-sizing: border-box;
            word-wrap: break-word;
            /* Handles long words gracefully */
            vertical-align: middle;
            /* Aligns with other inline elements */
        }

        .message i {
            margin-left: 10px;
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .message {
                font-size: 17px;
                padding: 10px 12px;
                /* Adjust padding for medium screens */
            }
        }

        @media (max-width: 768px) {
            .message {
                font-size: 16px;
                padding: 8px 10px;
                /* Adjust padding for small screens */
            }
        }

        @media (max-width: 600px) {
            .message {
                font-size: 15px;
                padding: 8px 10px;
                max-width: 95%;
                /* Slightly wider on very small screens */
            }
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