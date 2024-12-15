<?php
include 'Config.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// The page will show the content even if the user is not logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

  <style>
    @keyframes backgroundAnimation {
      0% { background: radial-gradient(circle, #1f0e01, #51341f); }
      50% { background: radial-gradient(circle, #51341f, #1f0e01); }
      100% { background: radial-gradient(circle, #1f0e01, #51341f); }
    }

    @keyframes slideInOnScroll {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .sliding-header {
      font-size: 3rem;
      font-weight: bold;
      color: #2c1402;
      text-align: center;
      animation: slideIn 1s ease-out;
      text-decoration: underline;
      text-decoration-color: #ff8c70;
      margin-bottom: 1.5rem;
    }

    .sliding-header a {
      color: #e69969;
      text-decoration: none;
      transition: text-decoration 0.3s, color 0.3s;
    }

    .sliding-header a:hover {
      text-decoration: underline;
      color: white;
    }

    .slide-in {
      opacity: 0;
      animation: slideInOnScroll 1s forwards;
    }

    .sliding-on-scroll {
      opacity: 0;
    }
  </style>
</head>
<body>

<?php
include 'User_Header.php';?>

<div class="about_heading" style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-flow: column; min-height: 15rem; padding: 2rem; animation: backgroundAnimation 5s infinite;">
  <h3 style="font-size: 5rem; color: white; text-transform: capitalize; margin: 0;">About Us</h3>
  <p style="font-size: 2.3rem; color: #aaaaaa; margin: 0;">
    <a href="index.php" style="color: #e69969; text-decoration: none;" onmouseover="this.style.textDecoration='underline'; this.style.color='white';" onmouseout="this.style.textDecoration='none'; this.style.color='#e69969';">Home</a>
    <span> | About</span>
  </p>
</div>

<section class="about" style="padding: 2rem;">
  <div class="row" style="display: flex; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
    <div class="image" style="flex: 1 1 40%; max-width: 40%;">
      <img src="Display_Images/About-us.jpg" alt="" style="width: 100%; height: auto; object-fit: cover; border-radius: 100px;">
    </div>

    <div class="content" style="flex: 1 1 50%; padding-left: 2rem; text-align: justify; display: flex; flex-direction: column; align-items: center; justify-content: center;">
      <h3 class="sliding-header slide-in">
        Why Choose Us?
      </h3>
      <p  class="slide-in" style="padding: 1rem 2rem; line-height: 1.8; font-size: 1.4rem; color: #dcdcdc; text-align: justify; background-color: #2b1b03; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 1.5rem;">
        At our bookstore, we pride ourselves on offering an extensive selection of books across various genres. Whether you're interested in fiction, non-fiction, history, or science, we have something for every reader.  
      </p>
      <a href="Shop_System.php" class="btn" style="display: inline-block; padding: 1rem 2rem; background-color: #2b1b03; color: white; text-decoration: none; border-radius: 15px; text-align: center; margin-top: 1rem; box-shadow: 0 4px 8px rgba(255, 255, 255, 0.6);" onmouseover="this.style.backgroundColor='#8B5A2B'" onmouseout="this.style.backgroundColor='#2b1b03'">Our Bookstore</a>
    </div>
  </div>
</section>

<section class="steps" style="padding: 2rem;">
  <h1 class="sliding-header sliding-on-scroll">
    Special Offers
  </h1>

  <div class="box-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; align-items: flex-start;">
    <div class="box sliding-on-scroll" style="text-align: center; border: 1px solid #ccc; padding: 2rem; width: 100%; background-color: #60310d; border-radius: 25px;">
      <img src="Icons/book-collection-icon.png" alt="" style="height: 10rem; width: 100%; object-fit: contain; margin-bottom: 1rem;">
      <h3 style="font-size: 1.8rem; margin: 1rem 0; color: #dcdcdc; text-transform: capitalize;">Browse Our Collection</h3>
      <p style="line-height: 1.8; font-size: 1rem; color: #dcdcdc;">Discover a wide range of books for all interests and ages. Find your next read today!</p>
    </div>

    <div class="box sliding-on-scroll" style="text-align: center; border: 1px solid #ccc; padding: 2rem; width: 100%; background-color: #60310d; border-radius: 25px;">
      <img src="Icons/fast-delivery-icon.jpg" alt="" style="height: 10rem; width: 100%; object-fit: contain; margin-bottom: 1rem;">
      <h3 style="font-size: 1.8rem; margin: 1rem 0; color: #dcdcdc; text-transform: capitalize;">Quick and Dependable Shipping</h3>
      <p style="line-height: 1.8; font-size: 1rem; color: #dcdcdc;">Enjoy fast and reliable shipping on all orders. Get your items delivered on time, every time.</p>
    </div>

    <div class="box sliding-on-scroll" style="text-align: center; border: 1px solid #ccc; padding: 2rem; width: 100%; background-color: #60310d; border-radius: 25px;">
      <img src="Icons/explore-timeless-classics.png" alt="" style="height: 10rem; width: 100%; object-fit: contain; margin-bottom: 1rem;">
      <h3 style="font-size: 1.8rem; margin: 1rem 0; color: #dcdcdc; text-transform: capitalize;">Explore Timeless Classics</h3>
      <p style="line-height: 1.8; font-size: 1rem; color: #dcdcdc;">Delve into a collection of classic books that have stood the test of time and continue to inspire.</p>
    </div>
  </div>
</section>

<section class="questions_cont">
  <div class="questions">
    <h2>Queries?</h2>
    <p>At NobleClassics, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn" onclick="window.location.href='Contact.php'">Contact Us</button>
  </div>
</section>

<?php
include 'Footer.php';
?>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="Script.js"></script>

<script>
// JavaScript to trigger slide-in animation on scroll
window.addEventListener('scroll', function() {
  const slidingElements = document.querySelectorAll('.sliding-on-scroll');
  slidingElements.forEach(function(element) {
    const elementPosition = element.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;
    if (elementPosition < windowHeight - 100) {  // Trigger when it's 100px from the viewport
      element.classList.add('slide-in');
    }
  });
});
</script>

</body>
</html>
