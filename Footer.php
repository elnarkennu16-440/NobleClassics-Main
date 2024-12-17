<section class="footer">
  <div class="footer_box_container">

    <div class="footer_box">
      <h3>Quick Links</h3>
      <a href="Login.php">Login</a>
      <a href="Register.php">Register</a>
      <a href="Shop_System.php">Shop</a>
      <a href="Cart_System.php">Cart</a>
    </div>

    <div class="footer_box">
      <h3>Helpful Links</h3>
      <a href="index.php">Home</a>
      <a href="About.php">About Us</a>
      <a href="Contact.php">Contact Us</a>
      <a href="Order_System.php">Order</a>
    </div>

    <div class="footer_box">
      <h3>NobleClassics</h3>
      <p><i class="fas fa-phone"></i> 09453870032</p>
      <p><i class="fas fa-envelope"></i>nc.books@gmail.com</p>
      <p><i class="fas fa-map-marker-alt"></i> Daet, Camarines Norte, Philippines</p>
      <p><i class="fa-solid fa-shop"></i>7:00am - 9:00pm</p>
    </div>
  </div>

  <div class="social-media">
    <a href="https://www.facebook.com"><img src="SocialMedia_Icons/facebook.png" alt="Facebook"></a>
    <a href="https://twitter.com"><img src="SocialMedia_Icons/twitter.png" alt="Twitter"></a>
    <a href="https://www.instagram.com"><img src="SocialMedia_Icons/instagram.png" alt="Instagram"></a>
    <a href="https://www.pinterest.com"><img src="SocialMedia_Icons/pinterest.png" alt="Pinterest"></a>
    <a href="https://www.messenger.com"><img src="SocialMedia_Icons/messenger.png" alt="Messenger"></a>
  </div>

  <p>Copyright <i class="fa-regular fa-copyright"></i> 2024 <span>NobleClassics | All Rights Reserved.</span></p>
</section>

<style>
  /* Footer Styles */
  .footer {
    background-color: #2b1b03;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-bottom: 2rem;
    gap: 1rem;
    cursor: pointer;
  }

  .footer_box_container {
    width: 90%;
    display: flex;
    padding: 2rem;
    justify-content: space-between;
    gap: 1rem;
  }

  .footer_box {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    width: 25%;
    /* Default width for desktop */
  }

  /* Footer Box Title */
  .footer_box h3 {
    font-size: 1.7rem;
    font-weight: 500;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
  }

  /* Footer Box Paragraph Text */
  .footer_box p {
    font-size: 1rem;
    letter-spacing: 1px;
    margin-top: 0.5rem;
    text-align: left;
  }

  /* Footer Links */
  .footer_box a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    letter-spacing: 0.6px;
    margin-top: 0.5rem;
  }

  .footer_box a:hover::after {
    content: "";
    display: block;
    width: 35px;
    border-bottom: 2px solid #db9d45;
    color: #805e49;
  }

  /* Footer Logo Container */
  .footer_logo_cont {
    width: 100%;
    display: flex;
    gap: 0.5rem;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .footer_logo_cont a {
    font-size: 1.7rem;
    font-weight: 500;
    letter-spacing: 1px;
  }

  .footer_logo_cont img {
    width: 10%;
  }

  /* Social Media Icons */
  .social-media {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 1rem;
  }

  .social-media a {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 10px;
  }

  .social-media img {
    width: 30px;
    height: auto;
  }

  /* Mobile Responsiveness */
  @media (max-width: 768px) {
    .footer_box {
      width: 30%;
      /* Slightly smaller width to fit content */
    }

    /* Footer Box Title */
    .footer_box h3 {
      font-size: 1.4rem;
      /* Smaller font size for headings */
    }

    /* Footer Box Paragraph Text */
    .footer_box p {
      font-size: 0.9rem;
      /* Smaller font size for paragraph text */
    }

    /* Specifically for the email paragraph */
    .footer_box p:nth-child(3) {
      font-size: 0.7rem;
      /* Make email smaller */
    }

    /* Footer Links */
    .footer_box a {
      font-size: 0.9rem;
      /* Smaller font size for links */
    }

    /* Footer Logo Text */
    .footer_logo_cont a {
      font-size: 1.5rem;
      /* Smaller font size for logo text */
    }

    /* Footer Logo Image */
    .footer_logo_cont img {
      width: 12%;
      /* Slightly bigger logo image */
    }

    /* Social Media Icons */
    .social-media img {
      width: 25px;
      /* Reduce icon size */
    }

    /* Ensure footer boxes are horizontally aligned */
    .footer_box_container {
      flex-wrap: nowrap;
      /* Prevent wrapping */
      gap: 1rem;
      /* Maintain spacing between columns */
    }
  }
</style>