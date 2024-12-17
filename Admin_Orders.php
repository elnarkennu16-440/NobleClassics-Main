<?php
include 'Config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:Login.php');
}

if (isset($_POST['update_order'])) {
  $order_update_id = $_POST['order_id'];
  $update_payment = $_POST['update_payment'];

  mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');

  $message[] = 'Order Payment Status has been Updated';
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `orders` WHERE id='$delete_id'");
  $message[] = '1 order has been deleted';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRATOR - ORDERS</title>
  <link rel="stylesheet" href="Admin.css">
  <link rel="stylesheet" href="Style.css">
</head>

<body
  style="background: linear-gradient(to left, #33164c, #3d2606); background-size: 300% 300%; animation: gradientShift 5s ease infinite;">

  <style>
    @keyframes gradientShift {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    @keyframes slideIn {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }

      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .admin_orders h1 {
      animation: slideIn 2s ease-out;
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
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .admin_orders h1 i {
      margin-right: 10px;
      font-size: 1.8rem;
      color: #fdc5a1;
    }
  </style>

  <?php
  include 'Admin_Header.php';
  ?>

  <section class="admin_orders">
    <h1 class="title"><i class="fa-solid fa-receipt"></i>CUSTOMER ORDERS</h1>

    <div class="admin_box_container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');

      if (mysqli_num_rows($select_orders) > 0) {
        while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
          ?>
          <div class="admin_box" style="background: linear-gradient(to left, #c598ec, #eec182); border-radius: 45px;">
            <p style="font-size: 1.2rem;">Account Id : <span
                style="color:#3f093a;"><?php echo $fetch_orders['user_id'] ?></span></p>
            <p style="font-size: 1.2rem;">Order Date : <span
                style="color:#3f093a;"><?php echo $fetch_orders['placed_on'] ?></span></p>
            <p style="font-size: 1.2rem;">Name : <span style="color:#3f093a;"><?php echo $fetch_orders['name'] ?></span></p>
            <p style="font-size: 1.2rem;">Number : <span style="color:#3f093a;"><?php echo $fetch_orders['number'] ?></span>
            </p>
            <p style="font-size: 1.2rem;">Email : <span style="color:#3f093a;"><?php echo $fetch_orders['email'] ?></span>
            </p>
            <p style="font-size: 1.2rem;">Address : <span
                style="color:#3f093a;"><?php echo $fetch_orders['address'] ?></span></p>
            <p style="font-size: 1.2rem;">Total Product Items : <span
                style="color:#3f093a;"><?php echo $fetch_orders['total_products'] ?></span></p>
            <p style="font-size: 1.2rem;">Total Price : <span
                style="color:#3f093a;"><?php echo $fetch_orders['total_price'] ?></span></p>
            <p style="font-size: 1.2rem;">Payment Method : <span
                style="color:#3f093a;"><?php echo $fetch_orders['method'] ?></span></p>

            <form action="" method="post">
              <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
              <select name="update_payment"
                style="background:#33164c; color:white; border-radius: 30px; border: 2px solid #ccc; padding: 10px; display: inline-block;">
                <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                <option value="Pending Actions">Payment Not Completed</option>
                <option value="Transaction Completed">Transaction Completed</option>
              </select>
              <input type="submit" value="Update Transactions" name="update_order" class="option-btn"
                style="background:#3d2606; color:white; border-radius: 30px; border: 2px solid #ccc; padding: 10px; display: inline-block;">
              <a href="Admin_Orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this order?');" class="delete-btn"
                style="background:#3f093a; color:white; border-radius: 30px; border: 2px solid #ccc; padding: 10px; display: inline-block;">Delete
                Transactions</a>
            </form>
          </div>
          <?php
        }
      } else {
        echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Orders are Available at the moment...</p>';
      }
      ?>
    </div>
  </section>

  <script src="Admin.js"></script>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>

</html>