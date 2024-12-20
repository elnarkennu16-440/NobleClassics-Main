<?php
include 'Config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:Login.php');
}

if (isset($_POST['order_btn'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $placed_on = date('d-M-Y');

  $cart_total = 0;
  $cart_products[] = '';

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
  if (mysqli_num_rows($cart_query) > 0) {
    while ($cart_item = mysqli_fetch_assoc($cart_query)) {
      $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
      $sub_total = ($cart_item['price'] * $cart_item['quantity']);
      $cart_total += $sub_total;
    }
  }

  $total_products = implode(' ', $cart_products);

  $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

  if ($cart_total == 0) {
    $message[] = 'Cart Contains no Products';
  } else {
    if (mysqli_num_rows($order_query) > 0) {
      $message[] = 'Your Order Already Placed!';
    } else {
      mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
      $message[] = 'Order Placed Successfully!';
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOBLECLASSICS - CHECKOUT</title>

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

  <div class="checkout_heading"
    style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-flow: column; min-height: 15rem; padding: 2rem; animation: backgroundAnimation 5s infinite; margin-bottom: 20px;">
    <h3 style="font-size: 5rem; color: white; text-transform: capitalize; margin: 0;">Order Confirmation</h3>
    <p style="font-size: 2.3rem; color: #aaaaaa; margin: 0;">
      <a href="Cart_System.php" style="color: #e69969; text-decoration: none;"
        onmouseover="this.style.textDecoration='underline'; this.style.color='white';"
        onmouseout="this.style.textDecoration='none'; this.style.color='#e69969';">Shopping Cart</a>
      <span> | Checkout</span>
    </p>
  </div>

  <section class="display_order">
    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {
      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
        $grand_total += $total_price;

        ?>
        <div class="single_order_product"
          style="background-color: #483e1b; border-radius: 15px; box-shadow: 0px 4px 10px rgb(241, 212, 161);">
          <img src="./Book_Images/<?php echo $fetch_cart['image']; ?>" alt="">
          <div class="single_des">
            <h3 style="color: #fdc5a1;"><?php echo $fetch_cart['name']; ?></h3>
            <p style="color: rgb(239, 157, 255);">₱. <?php echo $fetch_cart['price']; ?></p>
            <p style="color: #fdc5a1;">Quantity : <?php echo $fetch_cart['quantity']; ?></p>
          </div>

        </div>

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

          /* Payment options specific styles */
          .payment-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin: 1.5rem 0;
            background: #fff3e4;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          }

          .payment-options label {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #5a3b1a;
            background: #fff;
            border: 2px solid #e6c7a8;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
          }

          .payment-options input[type="radio"] {
            accent-color: #c69a6d;
            width: 1.2rem;
            height: 1.2rem;
            cursor: pointer;
          }

          .payment-options label:hover {
            background: #ffe5c4;
            border-color: #d8a87c;
            box-shadow: 0 4px 8px rgba(216, 168, 124, 0.3);
          }

          /* Responsive design for smaller screens */
          @media (max-width: 768px) {
            .payment-options {
              flex-direction: row;
              /* Change to horizontal alignment */
              justify-content: space-between;
              /* Ensure spacing between options */
              gap: 0.5rem;
              /* Adjust gap for better alignment */
            }

            .payment-options label {
              font-size: 1rem;
              /* Adjust font size for smaller screens */
              padding: 0.5rem;
              /* Adjust padding for smaller screens */
              flex: 1;
              /* Allow equal space for all labels */
              text-align: center;
              /* Center align text inside each option */
            }
          }
        </style>


        <?php
      }
    } else {
      echo '<p class="empty" style="padding: 1.5rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; border-radius: 20px; box-shadow: 0px 4px 10px white;">Cart Contains no Products..</p>';
    }
    ?>
    <div class="checkout_grand_total"> TOTAL ORDER AMOUNT : <span>₱<?php echo $grand_total; ?></span> </div>
  </section>



  <section class="payment_details" style="background: url('Display_Images/books-blur-background.jpg');">
    <form action="" method="post">
      <h3>Add Your Details</h3>
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <input type="phone" name="number" required placeholder="Enter your number" class="box">
      <input type="email" name="email" required placeholder="Enter your email" class="box">

      <div class="payment-options">
        <label>
          <input type="radio" name="method" value="Credit/Debit Card" required>
          Credit/Debit Card
        </label>
        <label>
          <input type="radio" name="method" value="Gcash/Paypal" required>
          Gcash/Paypal
        </label>
        <label>
          <input type="radio" name="method" value="Cash on Delivery" required>
          Cash on Delivery
        </label>
      </div>


      <textarea name="address" placeholder="Enter your home address" class="box" cols="30" rows="10"></textarea>
      <input type="submit" value="Confirm Your Order Details" name="order_btn" class="btn">
    </form>
  </section>


  <?php
  include 'Footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

  <script src="Script.js"></script>

</body>

</html>