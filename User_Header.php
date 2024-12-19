<?php
// Check if session has already started, if not, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
    // If user session values are not set, display default values or redirect.
    $_SESSION['user_name'] = 'Guest';  // You can change this to a placeholder name
    $_SESSION['user_email'] = 'guest@example.com';  // You can change this to a placeholder email
}
?>

<header class="user_header">
  <div class="header_1">
    <div class="user_flex">
      <div class="logo_cont">
        <img src="Display_Images/Book_Logo.png" alt="">
        <a href="index.php" class="book_logo">NobleClassics</a>
      </div>

      <nav class="navbar">
        <a href="index.php"><i class="fa-solid fa-house"></i> HOME</a>
        <a href="About.php"><i class="fa-solid fa-info-circle"></i> ABOUT</a>
        <a href="Shop_System.php"><i class="fa-solid fa-book"></i> BOOKSTORE</a>
        <a href="Contact.php"><i class="fa-solid fa-envelope"></i> CONTACT</a>
        <a href="Order_System.php"><i class="fa-solid fa-box"></i> ORDERS</a>
      </nav>

      <div class="last_part">
        <div class="loginorreg">
          <!-- Replace Login text with the user icon image -->
          <a href="Login.php" class="login-button">
            <img src="Icons/user_icon.png" alt="Login" style="width: 24px; height: 24px; border-radius: 50%;"> 
          </a>
        </div>
      </div>

      <div class="icons">
        <!-- Search Icon (Image version) -->
        <a href="Search_Bar.php" style="text-decoration: none;">
            <img src="Icons/search_bar_icon.png" alt="Search" style="width: 24px; height: 24px;" 
                 onmouseover="this.style.filter='brightness(0.8)';" 
                 onmouseout="this.style.filter='brightness(1)';">
        </a>

        <!-- User Icon (Image version) -->
        <div id="user_btn">
            <img src="Icons/logout_user_icon.png" alt="User" style="width: 24px; height: 24px;" 
                 onmouseover="this.style.filter='brightness(0.8)';" 
                 onmouseout="this.style.filter='brightness(1)';">
        </div>

        <?php
        // Ensure user is logged in and cart items are queried correctly
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
            $cart_row_number = mysqli_num_rows($select_cart_number);
        } else {
            $cart_row_number = 0; // Default to 0 if no user session is available
        }
        ?>

        <!-- Shopping Cart Icon (Image version) -->
        <a href="Cart_System.php" style="text-decoration: none;">
            <img src="Icons/shopping_cart_icon.png" alt="Cart" style="width: 24px; height: 24px;" 
                 onmouseover="this.style.filter='brightness(0.8)';" 
                 onmouseout="this.style.filter='brightness(1)';">
            <span class="quantity" onmouseover="this.style.color='#4E342E'" onmouseout="this.style.color='#fff'"><?php echo $cart_row_number ?></span>
        </a>

        <!-- Menu Icon -->
        <div id="user_menu_btn">
            <i class="fa-solid fa-bars" style="font-size: 24px;"></i>
        </div>
      </div>

      <div class="header_acc_box">
        <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
        <a href="Logout.php" class="delete-btn">Logout</a>
      </div>

    </div>
  </div>
</header>

<style>
  /* Add icons behind text (kept original styling) */
  .navbar a {
      position: relative;
      padding-left: 30px; /* Space for the icon */
      font-size: 0.9rem !important; /* Reduced font size */
      color:rgb(251, 191, 132) !important;
  }

  .navbar a i {
      position: absolute;
      left: 10px; /* Align the icon to the left */
      top: 50%;
      transform: translateY(-50%);
  }

  /* Keep original hover effect with underline */
  .navbar a:hover {
      text-decoration: underline;
      text-decoration-thickness: 2px; /* Add thickness for better visibility */
  }

  /* Mobile Responsiveness for Navbar */
@media (max-width: 768px) {
    .navbar {
        display: none; /* Hide navbar links by default */
        flex-direction: column;
        color: #deb583;
        background-color: rgb(65, 44, 19) !important; /* Set background color */
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: -1; /* Ensure it's below other elements when hidden */
    }

    .navbar.open {
        display: flex !important; /* Show navbar when 'open' class is added */
        z-index: 999; /* Ensure navbar appears above other elements */
    }

    .navbar a {
        padding: 10px;
        text-align: center;
        color: #fff;
        font-size: 1.2rem;
    }

    .navbar a:hover {
        background-color: #444;
    }

    #user_menu_btn {
        display: block;
        cursor: pointer;
    }

    #user_menu_btn i {
        font-size: 50px;
    }

    /* Hover effect for menu icon */
    #user_menu_btn i:hover {
        filter: brightness(1);
    }
}

  /* Keep original styling for login button */
  .last_part .loginorreg .login-button {
      color: #af6949;
      text-decoration: none;
      letter-spacing: 1px;
      border: 2px solid #af6949;
      background-color: transparent;
      padding: 5px 10px;
      border-radius: 25px;
      display: inline-block;
      text-align: center;
      transition: all 0.3s ease;
  }

  .last_part .loginorreg .login-button:hover {
      color: #d2a679;
      border-color: #d2a679;
      background-color: #4b1005;
      text-decoration: none;
  }

  /* Positioning the navbar at the right for larger screens */
  .user_flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
  }

  .navbar {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
  }
</style>

<script>
  // Toggle navbar visibility when the menu button is clicked
  document.getElementById('user_menu_btn').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('open');  // Toggle the 'open' class to show/hide the navbar
});
</script>
