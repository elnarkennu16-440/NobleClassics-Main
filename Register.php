<?php

include 'Config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `register` WHERE email='$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exists!';
    } else {
        if($password != $cpassword){
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="Login.css">
    
    <style>
        /* Message Box Styling */
.message {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #ffe4b5; /* Light orange background */
    color: #333; /* Darker text for contrast */
    font-size: 18px; /* Bigger font size */
    font-weight: 500;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 10px auto; /* Center in the middle */
    max-width: 90%; /* Responsive width */
    text-align: center;
    transition: 0.3s ease;
}

/* Dismiss button */
.message i {
    cursor: pointer;
    color: #ff6347; /* Light red for the close icon */
    font-size: 20px;
    margin-left: 10px;
    transition: 0.3s ease;
}

.message i:hover {
    color: #d62828; /* Darker red on hover */
}

/* Responsive Design */
@media (min-width: 768px) {
    .message {
        max-width: 60%; /* Larger screens: shrink width */
    }
}

    </style>
</head>

<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span>'.$message.'</span>
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
            <select name="user_type" >
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
