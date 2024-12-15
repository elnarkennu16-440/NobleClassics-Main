<?php
include 'Config.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// The page will show the content even if the user is not logged in

if (isset($_POST['send'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = $_POST['number'];
  $msg = mysqli_real_escape_string($conn, $_POST['message']);

  $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

  if (mysqli_num_rows($select_message) > 0) {
    $message[] = 'Your Already Sent a Message';
  } else {
    mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
    $message[] = 'Your Message was Successfully Sent';
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>

<body>

  <?php
  include 'User_Header.php';
  ?>

  <style>
    @keyframes backgroundAnimation {
      0% {
        background: radial-gradient(circle, #1f0e01, #51341f);
      }

      50% {
        background: radial-gradient(circle, #51341f, #1f0e01);
      }

      100% {
        background: radial-gradient(circle, #1f0e01, #51341f);
      }
    }
  </style>

  <div class="contact_heading"
    style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-flow: column; min-height: 15rem; padding: 2rem; animation: backgroundAnimation 5s infinite;">
    <h3 style="font-size: 5rem; color: white; text-transform: capitalize; margin: 0;">Contact Us</h3>
    <p style="font-size: 2.3rem; color: #aaaaaa; margin: 0;">
      <a href="index.php" style="color: #e69969; text-decoration: none;"
        onmouseover="this.style.textDecoration='underline'; this.style.color='white';"
        onmouseout="this.style.textDecoration='none'; this.style.color='#e69969';">Home</a>
      <span> | Contact</span>
    </p>
  </div>

  <section class="contact">

    <div class="row">

      <div class="image">
        <img src="Display_Images/contact-us.png" alt="Contact Us Illustration">
        <div class="contact-paragraphs">
          <p class="contact-description left">
            ☎ We value your feedback and inquiries. Whether you have questions about our services, need assistance with
            a
            specific issue,
            or simply want to share your thoughts, we’re here to listen and provide the support you need.
          </p>
          <p class="contact-description right">
            ☎ Don’t hesitate to get in touch with us! Our dedicated team is ready to assist you and ensure that your
            experience with us
            is nothing short of exceptional. Let us know how we can help today!
          </p>
        </div>
      </div>


      <style>
        .contact {
          padding: 2rem 1rem;
        }

        .contact .row {
          display: flex;
          align-items: center;
          flex-wrap: wrap;
          gap: 2rem;
          justify-content: center;
        }

        .contact .row .image {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
        }


        .contact .row .image img {
          width: 100%;
          max-width: 150px;
          height: auto;
          object-fit: cover;
          border-radius: 50%;
          margin-bottom: 1rem;
        }

        .contact .row .image {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
        }

        .contact .row .image .contact-paragraphs {
          display: flex;
          justify-content: space-between;
          width: 100%;
          max-width: 80%;
          margin-top: 1rem;
        }

        .contact .row .image .contact-description {
          text-align: justify;
          padding: 1rem;
          background-color: #2b1f15;
          border: 10px solid #d2a679;
          border-radius: 10px;
          border-style: double;
          font-size: 11px;
          color: #e4b480;
          max-width: 49%;
          box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
          line-height: 1.4;
        }

        .contact .row form {
          flex: 1 1 45%;
          max-height: 550px;
          max-width: 80%;
          padding: 1rem;
          position: relative;
          background: url('Display_Images/books-blur-background.jpg') center/cover no-repeat;
          border-radius: 20px;
          box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
          text-align: center;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }

        .contact .row form .form-overlay {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: rgba(0, 0, 0, 0.5);
          filter: blur(12px);
          z-index: -1;
          border-radius: 20px;
        }

        .contact .row form h3 {
          font-size: 2rem;
          color: #ffffff;
          margin-bottom: 2.3rem;
          position: relative;
          z-index: 1;
        }

        .contact .row form .box {
          margin: 0.8rem 0;
          font-size: 1rem;
          color: #333;
          border: 1px solid #ccc;
          padding: 0.8rem;
          width: 70%;
          border-radius: 10px;
          outline: none;
          position: relative;
          z-index: 1;
        }

        .contact .row form textarea {
          height: 5rem;
          resize: none;
          border-radius: 15px;
          outline: none;
          position: relative;
          z-index: 1;
        }

        .contact .row form .box:focus,
        .contact .row form textarea:focus {
          outline: 2px solid #c88a3a;
        }

        .contact .row form .btn {
          width: 150px;
          padding: 0.6rem;
          margin-top: 1rem;
          border-radius: 20px;
          font-size: 1rem;
          background-color: #f8b596;
          color: #060606;
          cursor: pointer;
          transition: background-color 0.3s ease, color 0.3s ease;
          position: relative;
          z-index: 1;
        }

        .contact .row form .btn:hover {
          background-color: #3e1f15;
          color: #ffffff;
        }

        @media (max-width: 768px) {
          .contact .row {
            flex-direction: column;
            align-items: center;
          }

          .contact .row .image,
          .contact .row form {
            flex: 1 1 100%;
            max-width: 90%;
          }

          .contact .row .image img {
            max-width: 100px;
            /* Ensure the image is smaller on smaller screens */
            height: auto;
          }
        }
      </style>

      <form action="" method="post">

        <!-- Blurred background effect -->
        <div class="form-overlay">
        </div>

        <h3>Provide Your Feedback</h3>
        <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
        <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Enter your number" required
          maxlength="10">
        <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" required>
        <textarea name="message" class="box" required placeholder="Enter your message" maxlength="500" cols="30"
          rows="10"></textarea>
        <input type="submit" value="Send Message" name="send" class="btn">
      </form>

    </div>
  </section>




  <?php
  include 'Footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

  <script src="Script.js"></script>

</body>

</html>