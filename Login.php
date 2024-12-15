<?php

include 'Config.php';
session_start();

if(isset($_POST['submit'])){

    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,md5($_POST['password']) );

    $select_users=mysqli_query($conn,"SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $row=mysqli_fetch_assoc($select_users);

        if($row['user_type'] =='admin'){
            $_SESSION['admin_name']=$row['name'];
            $_SESSION['admin_email']=$row['email'];
            $_SESSION['admin_id']=$row['id'];
            header('location:Admin_Page.php');  // Redirect to admin page
        }elseif($row['user_type'] =='user'){
            $_SESSION['user_name']=$row['name'];
            $_SESSION['user_email']=$row['email'];
            $_SESSION['user_id']=$row['id'];
            header('location:index.php');  // Redirect to Home.php after successful login
            exit;  // Make sure the script stops here and does not execute further
        }
    }else{
        $message[]='Incorrect email or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOBLECLASSICS-LOGIN</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Login.css">

  <style>
    /* Default for larger screens (desktop) */
    .animated-text {
      position: relative;
      text-align: center;
      width: 25%;
      padding-right: 40px;
      display: flex;
      justify-content: center;
    }
    

    .animated-text span { 
      display: block; /* Remove flex */
    }

    .animated-text span::before {
      content: ""; 
      display: block; 
      width: 130px; /* Increased width */
      height: 130px; /* Increased height */
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 10px; 
      background-image: url("Display_Images/login-profile.png"); 
      background-size: cover; 
    }


    .animated-text span::after{
      content: "";
      position: absolute;
      width: 5px;
      height: 60%;
      border-left: 3px solid burlywood;
      animation: cursor .8s infinite typing 20s steps(14) infinite;
    }

    @keyframes cursor {
      to {
        border-left: 2px solid burlywood;
      }
    }

    @keyframes words {
      0%,20% {
        content: "Welcome To NobleClassics";
      }
      21%,40% {
        content: "Explore Classic Literature Books";
      }
      41%,60% {
        content: "Best Noble Deals";
      }
      61%,80% {
        content: "Your Choice Your Click!";
      }
      81%,100% {
        content: "Login and Register Now";
      }

    }

    @keyframes typing {
      10%,15%,30%,35%,50%,55%,70%,75%,90%,95%{
        width: 0;
      }
      5%,20%,25%,40%,45%,60%,65%,80%,85%{
        width: calc(100% + 8px);
      }
    }

    /* For smaller screens (mobile) */
    @media (max-width: 600px) {
      .animated-text {
        position: absolute;
        top: 80px; /* Adjust top for mobile */
        width: 100%; 
        font-size: 8vw; 
        text-align: center;
        flex-direction: row; 
        justify-content: center; 
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

<div class="animated-text" style="color: white; font-family: 'Montserrat', sans-serif; padding-right: 40px; display: flex; align-items: center; justify-content: center; height: 100px; width: 35%; font-size: 35px; text-align: center;">
  <span style="margin-left: auto; margin-right: auto;"></span> 
</div>


<script>
  document.addEventListener("DOMContentLoaded", function () {
  const animatedText = document.querySelector('.animated-text span');
  const messages = [
    "Welcome To NobleClassics",
    "Explore Different Classic Literature",
    "Access Exclusive Selections of Classic Works",
    "Your Choice Your Click",
  ];

  let currentMessageIndex = 0;
  let charIndex = 0;
  let typingSpeed = 100; // Speed of typing (ms)
  let erasingSpeed = 50; // Speed of erasing (ms)
  let newTextDelay = 2000; // Delay before typing new message

  animatedText.style.color = 'burlywood';
  animatedText.style.fontWeight = 'bold';
  animatedText.style.fontSize = '40px';  // You can adjust the font size
  animatedText.style.textShadow = '2px 2px 2px #3f2800'; // Add white shadow effect

  function type() {
    if (charIndex < messages[currentMessageIndex].length) {
      animatedText.textContent += messages[currentMessageIndex].charAt(charIndex);
      charIndex++;
      setTimeout(type, typingSpeed);
    } else {
      setTimeout(erase, newTextDelay);
    }
  }

  function erase() {
    if (charIndex > 0) {
      animatedText.textContent = messages[currentMessageIndex].substring(0, charIndex - 1);
      charIndex--;
      setTimeout(erase, erasingSpeed);
    } else {
      currentMessageIndex = (currentMessageIndex + 1) % messages.length;
      setTimeout(type, typingSpeed);
    }
  }

  // Start the typing animation
  type();
});
</script>

<div class="box login_box">
  <span class="borderline"></span>
  <form action="" method="post">
  <h2>Login Account</h2>

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
    
    <div class="links">
      <a href="ForgotPassword.php">Forgot Password?</a>
      <a href="Register.php">Create an Account</a>
    </div>

    <input type="submit" value="Login" name="submit">
  </form>
</div>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
</body>
</html>