<?php
include 'Config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:Login.php');
}

if(isset($_POST['order_btn'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $placed_on = date('d-M-Y');

  $cart_total = 0;
  $cart_products[] = '';

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(' ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Cart Contains no Products';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Your Order Already Placed!'; 
      }else{
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

</head>
<body>
  
<?php
include 'User_Header.php';
?>

<section class="display_order">
<h2 style="padding: 1.5rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; border-radius: 20px; box-shadow: 0px 4px 10px white; margin-top: 30px;">Purchased Product Details</h2>
  <?php
    $grand_total=0;
    $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart)>0){
      while($fetch_cart=mysqli_fetch_assoc($select_cart)){
        $total_price=($fetch_cart['price'] * $fetch_cart['quantity']);
        $grand_total+=$total_price;
      
  ?>
  <div class="single_order_product" style="background-color: #483e1b; border-radius: 15px; box-shadow: 0px 4px 10px rgb(241, 212, 161);">
    <img src="./Book_Images/<?php echo$fetch_cart['image'];?>" alt="">
    <div class="single_des">
    <h3 style="color: #fdc5a1;"><?php echo $fetch_cart['name'];?></h3>
    <p style="color: rgb(239, 157, 255);">₱. <?php echo $fetch_cart['price'];?></p>
    <p style="color: #fdc5a1;">Quantity : <?php echo $fetch_cart['quantity'];?></p>
    </div>

  </div>
  

  <?php
  }
}else{
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
        <input type="radio" name="method" value="online payment" required>
        Online Payment
      </label>
      <label>
        <input type="radio" name="method" value="cash on delivery" required>
        Cash on Delivery
      </label>
    </div>

    <textarea name="address" placeholder="Enter your address" class="box" cols="30" rows="10"></textarea>
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