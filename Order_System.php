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
  <title>NOBLECLASSICS - TRANSACTION ORDERS</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

  <style>
    @keyframes backgroundAnimation {
      0% { background: radial-gradient(circle, #1f0e01, #51341f); }
      50% { background: radial-gradient(circle, #51341f, #1f0e01); }
      100% { background: radial-gradient(circle, #1f0e01, #51341f); }
    }
    
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      flex-grow: 1; /* This will allow content to take up available space */
    }
    
    .order_heading {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      flex-flow: column;
      min-height: 15rem;
      padding: 2rem;
      animation: backgroundAnimation 5s infinite;
    }
    
    .order_heading h3 {
      font-size: 5rem;
      color: white;
      text-transform: capitalize;
      margin: 0;
    }
    
    .order_heading p {
      font-size: 2.3rem;
      color: #aaaaaa;
      margin: 0;
    }
    
    .order_heading a {
      color: #e69969;
      text-decoration: none;
    }

    .order_heading a:hover {
      text-decoration: underline;
      color: white;
    }
    
    .orders_cont {
      margin-bottom: 80px; /* Ensure space for footer */
    }
    
    .orders_box {
      box-shadow: 0px 4px 10px white;
      background-color: #805e49;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 25px;
      margin-bottom: 20px;
    }
    
    .orders_box p {
      margin: 5px 0;
    }
    
    .orders_box span {
      color: #fdc5a1;
    }

    .empty {
      padding: 1rem;
      text-align: center;
      background: linear-gradient(to bottom, #29113b, #34240b);
      color: #fdc5a1;
      font-size: 1.5rem;
      font-weight: bold;
      width: fit-content;
      margin: 0 auto;
      margin-bottom: 20px;
      margin-top: 30px;
      border-radius: 20px;
      box-shadow: 0px 4px 10px white;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: auto; /* Ensures the footer is pushed to the bottom */
    }

    @media (max-width: 768px) {
      .order_heading h3 {
        font-size: 3rem;
      }
      
      .order_heading p {
        font-size: 1.5rem;
      }

      .orders_box {
        padding: 15px;
      }

      .orders_box p {
        font-size: 1.2rem;
      }

      .orders_box span {
        font-size: 1.2rem;
      }

      .empty {
        font-size: 1.2rem;
      }
    }

    @media (max-width: 480px) {
      .order_heading h3 {
        font-size: 2.5rem;
      }

      .order_heading p {
        font-size: 1.2rem;
      }

      .orders_box p {
        font-size: 1rem;
      }

      .orders_box {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  
<?php
include 'User_Header.php';
?>

<div class="main-content">
  <div class="order_heading">
    <h3>Transaction Orders</h3>
    <p>
      <a href="index.php" onmouseover="this.style.textDecoration='underline'; this.style.color='white';" onmouseout="this.style.textDecoration='none'; this.style.color='#e69969';">Home</a>
      <span> | Orders</span>
    </p>
  </div>

  <section class="orders">
    <div class="orders_cont">
      <?php
      $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');

      if (mysqli_num_rows($order_query) > 0) {
        while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
      ?>
        <div class="orders_box">
          <p> Purchase Date : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
          <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
          <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
          <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
          <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
          <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
          <p> Order Details : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
          <p> Total Amount : <span>₱<?php echo $fetch_orders['total_price']; ?></span> </p>
          <p> Payment Confirmation : <span style="color: <?php echo ($fetch_orders['payment_status'] == 'pending') ? 'red' : 'green'; ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
        </div>
      <?php
        }
      } else {
        echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Orders have been Placed yet..</p>';
      }
      ?>
    </div>
  </section>
</div>

<?php
include 'Footer.php';
?>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="Script.js"></script>

</body>
</html>
