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

<header class="admin_header">
    <div class="header_navigation">
      <a href="Admin_Page.php" class="header_logo" style="color: #b7a7ff; box-shadow: 2px 2px 11px rgb(165, 165, 165); padding: 5px; border-radius: 10px; font-size: 20px;">ADMIN <span style="color: #f6bb63;">PANEL</span></a>

      <nav class="header_navbar">
        <a href="Admin_Page.php" style="transition: all 0.3s ease; font-size: 13px; padding: 3px 8px;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
          <i class="fa-solid fa-chart-line" style="margin-right: 5px; transition: transform 0.3s ease; font-size: 14px;"></i> <span style="transition: transform 0.3s ease;">REPORTS</span>
        </a>
        <a href="Admin_Products.php" style="transition: all 0.3s ease; font-size: 13px; padding: 3px 8px;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
          <i class="fas fa-book" style="margin-right: 5px; transition: transform 0.3s ease; font-size: 14px;"></i> <span style="transition: transform 0.3s ease;">PRODUCTS</span>
        </a>
        <a href="Admin_Orders.php" style="transition: all 0.3s ease; font-size: 13px; padding: 3px 8px;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
          <i class="fa-solid fa-receipt" style="margin-right: 5px; transition: transform 0.3s ease; font-size: 14px;"></i> <span style="transition: transform 0.3s ease;">ORDERS</span>
        </a>
        <a href="Admin_Users.php" style="transition: all 0.3s ease; font-size: 13px; padding: 3px 8px;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
          <i class="fa-solid fa-users" style="margin-right: 5px; transition: transform 0.3s ease; font-size: 14px;"></i> <span style="transition: transform 0.3s ease;">USERS</span>
        </a>
        <a href="Admin_Messages.php" style="transition: all 0.3s ease; font-size: 13px; padding: 3px 8px;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
          <i class="fa-solid fa-envelope" style="margin-right: 5px; transition: transform 0.3s ease; font-size: 14px;"></i> <span style="transition: transform 0.3s ease;">MESSAGES</span>
        </a>
      </nav>

      <div class="header_icons">
        <div id="menu_btn" class="fas fa-bars" style="font-size: 20px;"></div>
        <div id="user_btn" class="fas fa-user" style="font-size: 20px;"></div>
      </div>
      <div class="header_acc_box">
        <p style="font-size: 14px;">Username : <span><?php echo $_SESSION['admin_name'];?></span></p>
        <p style="font-size: 14px;">Email : <span><?php echo $_SESSION['admin_email'];?></span></p>
        <a href="Logout.php" class="delete-btn" style="font-size: 14px;">Logout</a>
      </div>
    </div>
</header>

<style>
 
  /* Mobile responsiveness adjustments */
  @media (max-width: 768px) {
      .header_navbar {
          background-color:rgb(57, 16, 87) !important; /* Keep the dark violet background for mobile */
      }

      .header_navbar a {
          padding: 10px;
          font-size: 1.2rem;
          text-align: center;
      }
  }
</style>

<script>
  document.getElementById('menu_btn').addEventListener('click', function() {
      const navbar = document.querySelector('.header_navbar');
      navbar.classList.toggle('open');
  });
</script>
