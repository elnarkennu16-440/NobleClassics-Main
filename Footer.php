<section class="footer">
  <div class="footer_box_container">

    <div class="footer_box">
      <h3>Quick Links</h3>
      <a href="Login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
      <a href="Register.php"><i class="fas fa-user-plus"></i> Register</a>
      <a href="Shop_System.php"><i class="fas fa-store"></i> Shop</a>
      <a href="Cart_System.php"><i class="fas fa-shopping-cart"></i> Cart</a>
    </div>

    <div class="footer_box">
      <h3>Helpful Links</h3>
      <a href="index.php"><i class="fas fa-home"></i> Home</a>
      <a href="About.php"><i class="fas fa-info-circle"></i> About Us</a>
      <a href="Contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a>
      <a href="Order_System.php"><i class="fas fa-box"></i> Order</a>
    </div>

    <div class="footer_box">
      <h3>NobleClassics</h3>
      <p><i class="fas fa-phone"></i> 09453870032</p>
      <p><i class="fas fa-envelope"></i> nc4shop@gmail.com</p>
      <p><i class="fas fa-map-marker-alt"></i> Daet, Camarines Norte, Philippines</p>
      <p><i class="fa-solid fa-shop"></i> 7:00am - 9:00pm</p>
    </div>
  </div>

  <div class="social-media">
    <a href="https://www.facebook.com"><img src="SocialMedia_Icons/facebook.png" alt="Facebook"></a>
    <a href="https://twitter.com"><img src="SocialMedia_Icons/twitter.png" alt="Twitter"></a>
    <a href="https://www.instagram.com"><img src="SocialMedia_Icons/instagram.png" alt="Instagram"></a>
    <a href="https://www.pinterest.com"><img src="SocialMedia_Icons/pinterest.png" alt="Pinterest"></a>
    <a href="https://www.messenger.com"><img src="SocialMedia_Icons/messenger.png" alt="Messenger"></a>
  </div>

  <div class="copyright">
    <p>Copyright <i class="fa-regular fa-copyright"></i> 2024 <span>NobleClassics | All Rights Reserved.</span></p>
  </div>
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
    font-size: 16px;
    /* Adjusted font size to 16px smaller */
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
    font-size: 1.2rem;
    /* Adjusted to 16px smaller */
    font-weight: 500;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
  }

  /* Footer Box Paragraph Text */
  .footer_box p {
    font-size: 0.8rem;
    /* Adjusted to 16px smaller */
    letter-spacing: 1px;
    margin-top: 0.5rem;
    text-align: left;
  }

  /* Footer Links */
  .footer_box a {
    color: white;
    text-decoration: none;
    font-size: 0.8rem;
    /* Adjusted to 16px smaller */
    letter-spacing: 0.6px;
    margin-top: 0.5rem;
  }

  .footer_box a i {
    margin-right: 5px;
    /* Add space between icons and text */
  }

  /* Footer Box Hover Effect */
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
    font-size: 1.5rem;
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
    width: 25px;
    /* Reduced icon size */
    height: auto;
  }

  .copyright {
    margin-top: 1rem;
    text-align: center;
    /* Center the text */
  }

  .copyright p {
    font-size: 1rem;
    margin: 0;
  }


  /* Mobile Responsiveness */
  @media (max-width: 768px) {
    .footer_box {
      width: 30%;
      /* Slightly smaller width to fit content */
    }

    .footer_box h3 {
      font-size: 1.2rem;
      /* Smaller font size for headings */
    }

    .footer_box p {
      font-size: 0.6rem;
      /* Smaller font size for paragraph text */
    }

    .footer_box a {
      font-size: 0.6rem;
      /* Smaller font size for links */
    }

    .footer_logo_cont a {
      font-size: 1.3rem;
    }

    .footer_logo_cont img {
      width: 12%;
    }

    .social-media img {
      width: 20px;
    }

    .footer_box_container {
      flex-wrap: wrap;
      gap: 1rem;
    }

    .copyright p {
      font-size: 0.8rem;
      /* Smaller font size */
    }

    .copyright {
      margin-top: 1rem;
      /* Adjust the margin for smaller screens */
    }
  }
</style>