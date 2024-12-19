<?php
session_start();
include 'Config.php';
require 'vendor/autoload.php'; // Include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = [];

// Step 1: Email verification and sending confirmation code
if (isset($_POST['verify_email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $check_user = mysqli_query($conn, "SELECT * FROM `register` WHERE email='$email'") or die('Query failed');

    if (mysqli_num_rows($check_user) > 0) {
        // Generate a random code for email verification
        $verification_code = rand(100000, 999999);
        $_SESSION['email_verification'] = ['email' => $email, 'code' => $verification_code];

        // Send the verification code via email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nc4shop@gmail.com'; // Your Gmail email
            $mail->Password = 'ecsv juvq ifoc cuga'; // Replace with your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('nc4shop@gmail.com', 'NobleClassics');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Verification Code';
            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: rgb(0, 0, 0);
                        padding: 20px;
                    }
                    .container {
                        background-color: rgb(75, 58, 23);
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgb(241, 204, 123);
                        max-width: 600px;
                        margin: 0 auto;
                    }
                    h2 {
                        color: rgb(65, 41, 12);
                    }
                    p {
                        color: rgb(0, 0, 0);
                        font-size: 16px;
                        line-height: 1.5;
                    }
                    .code {
                        background-color:rgb(0, 0, 0);
                        padding: 10px;
                        border-radius: 4px;
                        font-size: 18px;
                        font-weight: bold;
                        text-align: center;
                        margin: 10px 0;
                    }
                    .footer {
                        margin-top: 10px;
                        font-size: 12px;
                        color: rgb(65, 41, 12);
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Password Reset Verification</h2>
                    <p>Dear User,</p>
                    <p>We received a request to reset your password. Please use the following verification code to proceed with resetting your password:</p>
                    <p class='code'>$verification_code</p>
                    <p>If you didn't request this, you can safely ignore this email.</p>
                    <div class='footer'>
                        <p>Best regards,</p>
                        <p>NobleClassics</p>
                    </div>
                </div>
            </body>
            </html>
        ";
        

            $mail->send();
            $message[] = "A verification code has been sent to your gmail. Please enter the code to proceed.";

            header("Location: Enter_Verification.php");
            exit();
        } catch (Exception $e) {
            $message[] = "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        $message[] = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOBLECLASSICS - FORGOT PASSWORD</title>
</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="message">
                <span>' . $msg . '</span>
                <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <div class="box forgot_password_box">
        <form action="" method="post">
            <h2>Forgot Password</h2>
            <div class="inputbox">
                <input type="email" name="email" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <input type="submit" name="verify_email" value="Verify Email">
            <div class="links">
                <a href="Login.php">Back to Login Account</a>
            </div>
        </form>
    </div>


   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

      :root {
         --bg-col: #fff;
         --box-col: transparent;
         --mov-col1: #ffa200;
         --mov-col2: #c53f21;
         --form-col: linear-gradient(to right, #ff948b, #e7bc50);
         --blk-col: #3d3220;
         --whi-col: #fff;
         --inp-col: #7b1515;

      }

      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins', sans-serif;
      }


      body {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 100vh;
         margin: 0;
         background: url('Display_Images/Classic_Background_Image.jpg') no-repeat center center/cover;
         backdrop-filter: blur(5px);
         -webkit-backdrop-filter: blur(5px)
      }

      .message {
         background-color: linear-gradient(to bottom, #654321, #000000);
         width: 100%;
         z-index: 100000;
         position: absolute;
         top: 0;
         left: 0;
         margin-bottom: 1rem;
         padding: 10px;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .message span {
         font-size: 1rem;
         color: var(--black);
      }

      .message i {
         cursor: pointer;
         color: red;
         font-size: 1rem;
      }

      .message i:hover {
         transform: rotate(90deg);
      }

      body {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 100vh;
         background-color: var(--bg-col);
      }



      .box {
         position: relative;
         width: 450px;
         height: 380px;
         background: var(--blk-col);
         border-radius: 8px;
         overflow: hidden;
         box-shadow: inset 20px 20px 20px rgba(0, 0, 0, 0.05),
            25px 35px 20px rgba(0, 0, 0, 0.05),
            25px 30px 30px rgba(0, 0, 0, 0.05),
            inset -20px -20px 25px rgba(0, 0, 0, 0.9);
      }

      .box::before {
         content: '';
         position: absolute;
         top: -50%;
         left: -50%;
         width: 450px;
         height: 600px;
         background: linear-gradient(0deg, transparent, transparent, var(--mov-col1), var(--mov-col1));
         z-index: 1;
         transform-origin: bottom right;
         animation: animate 6s linear infinite;
      }

      .box::after {
         content: '';
         position: absolute;
         top: -50%;
         left: -50%;
         width: 450px;
         height: 600px;
         background: linear-gradient(0deg, transparent, transparent, var(--mov-col1), var(--mov-col1));
         z-index: 1;
         transform-origin: bottom right;
         animation: animate 6s linear infinite;
         animation-delay: -3s;
      }

      .borderline {
         position: absolute;
         top: 0;
         inset: 0;
      }

      .borderline::before {
         content: '';
         position: absolute;
         top: -50%;
         left: -50%;
         width: 450px;
         height: 600px;
         background: linear-gradient(0deg, transparent, transparent, var(--mov-col2), var(--mov-col2));
         z-index: 1;
         transform-origin: bottom right;
         animation: animate 6s linear infinite;
         animation-delay: -1.5s;
      }

      .borderline::after {
         content: '';
         position: absolute;
         top: -50%;
         left: -50%;
         width: 450px;
         height: 600px;
         background: linear-gradient(0deg, transparent, transparent, var(--mov-col2), var(--mov-col2));
         z-index: 1;
         transform-origin: bottom right;
         animation: animate 6s linear infinite;
         animation-delay: -4.5s;
      }

      @keyframes animate {
         0% {
            transform: rotate(0deg);
         }

         100% {
            transform: rotate(360deg);
         }
      }

      .box form {
         position: absolute;
         inset: 4px;
         padding: 20px 40px;
         border-radius: 8px;
         background: var(--form-col);
         background-size: cover;
         /* Ensure the gradient fills the area */
         z-index: 2;
         display: flex;
         flex-direction: column;
      }

      .box form h2 {
         color: var(--blk-col);
         font-weight: 500;
         text-align: center;
         letter-spacing: 0.1rem;

      }

      .box form .inputbox {
         position: relative;
         width: 100%;
         margin-top: 25px;
      }

      .box form .inputbox input {
         position: relative;
         width: 100%;
         padding: 15px 10px 10px;
         background: transparent;
         border: none;
         outline: none;
         box-shadow: none;
         color: var(--bg-col);
         font-size: 1rem;
         letter-spacing: 0.05rem;
         transition: 0.5s;
         z-index: 10;
      }

      .box form .inputbox span {
         position: absolute;
         left: 0;
         padding: 15px 0px 10px;
         pointer-events: none;
         color: var(--inp-col);
         font-size: 1rem;
         letter-spacing: 0.05rem;
         transition: 0.5s;
      }

      .box form .inputbox input:valid~span,
      .box form .inputbox input:focus~span {
         color: var(--blk-col);
         font-size: 0.9em;
         transform: translateY(-34px);
      }

      .box form .inputbox i {
         position: absolute;
         left: 0;
         bottom: 0;
         width: 100%;
         height: 2px;
         background: var(--blk-col);
         border-radius: 4px;
         overflow: hidden;
         transition: 0.5s;
         pointer-events: none;
      }

      .box form .inputbox input:valid~i,
      .box form .inputbox input:focus~i {
         height: 44px;
      }

      .box form .links {
         display: flex;
         justify-content: space-between;
      }

      .box form .links a {
         margin: 20px 0;
         font-size: 0.9em;
         color: var(--inp-col);
         text-decoration: none;
      }

      .box form .links a:hover {
         color: var(--blk-col);
         text-decoration: underline;
      }

      .box form input[type="submit"] {
         border: none;
         outline: none;
         padding: 9px 25px;
         background: rgb(219, 122, 47);
         cursor: pointer;
         font-size: 1em;
         border-radius: 35px 35px 35px 35px;
         font-weight: 600;
         width: 70%;
         justify-content: center;
         color: var(--blk-col);
         letter-spacing: 1px;
         margin: 0 auto;
         margin-top: 15px;
      }

      .box form input[type="submit"]:active {
         opacity: 0.8;
      }

      .box form input[type="submit"]:hover {
         background-color: var(--blk-col);
         color: var(--whi-col);
         font-weight: 500;
      }


      .box form select {
         width: 100%;
         padding: 20px 0px 10px;
         background: transparent;
         border: none;
         outline: none;
         box-shadow: none;
         color: var(--inp-col);
         font-size: 1rem;
         letter-spacing: 0.05rem;
      }


      .box form .inputbox select:valid {
         color: #000;
      }

      /* Login Form */
      .login_box {
         width: 450px;
         height: 380px;
      }

      .login_box form {
         padding: 20px;
      }

      .login_box form .inputbox {
         margin-top: 35px;
      }

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

      @media (max-width: 600px) {
         .box {
            width: 90%;
            padding: 15px;
            margin-top: 10px;
         }
      }
   </style>
</body>

</html>