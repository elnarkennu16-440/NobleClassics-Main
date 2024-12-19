<?php
include 'Config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:Login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRATOR - REPORTS</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="Admin.css">
  <link rel="stylesheet" href="Style.css">

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

    /* Animation for the "REPORTS" header */
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

    body {
      background: linear-gradient(to left,rgb(68, 34, 2),rgb(43, 27, 4));
      background-size: 300% 300%;
      animation: gradientShift 5s ease infinite;
      margin: 0;
      padding: 0;
    }

    .admin_dashboard {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    .admin_box_container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .admin_box {
      background-color: darksalmon !important;
      padding: 40px;
      border-radius: 40px !important;
      box-shadow: 2px 2px 10px rgb(219, 176, 254);
      width: 280px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .admin_box h3 {
      font-size: 24px;
      margin: 10px 0;
    }

    .admin_box p {
      font-size: 16px;
    }

    /* Hover effect */
    .admin_box:hover {
      transform: scale(1.05);
      box-shadow: 2px 2px 20px rgba(219, 176, 254, 0.7);
    }

    @media screen and (max-width: 768px) {
      .admin_box {
        width: 100%;
        padding: 20px;
      }
    }

    /* Styling for the "REPORTS" header */
    .reports-header {
      font-size: 36px;
      font-weight: bold;
      border-radius: 40px;
      color: darksalmon;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: slideIn 1s ease-out;
    }

    .reports-header i {
      margin-right: 10px;
      font-size: 40px;
      color: darksalmon;
    }

    /* General container for the chart */
    .graph-container {
      max-width: 100%;
      margin: 30px auto;
      padding: 20px;
      text-align: center;
    }

    /* Style for the canvas */
    #adminGraph {
      width: 100%;
      /* Use 100% of the container's width */
      height: 500px;
      /* Set a fixed height for the graph */
      max-width: 1200px;
      /* Maximum width */
      margin: 0 auto;
      border: 2px solid #ccc;
      border-radius: 10px;
    }
  </style>

</head>

<body>

  <?php
  include 'Admin_Header.php';
  ?>

  <section class="admin_dashboard">
    <div class="reports-header">
      <i class="fas fa-chart-line"></i>
      REPORTS
    </div>

    <div class="admin_box_container">

      <!-- Pending Payments -->
      <div class="admin_box">
        <?php
        $total_pendings = 0;
        $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');

        if (mysqli_num_rows($select_pending) > 0) {
          while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
            $total_price = $fetch_pendings['total_price'];
            $total_pendings += $total_price;
          }
        }
        ?>
        <h3>₱. <?php echo $total_pendings; ?></h3>
        <p>PENDING PAYMENT TRANSACTIONS</p>
      </div>

      <!-- Completed Payments -->
      <div class="admin_box">
        <?php
        $total_completed = 0;
        $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');

        if (mysqli_num_rows($select_completed) > 0) {
          while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
            $total_price = $fetch_completed['total_price'];
            $total_completed += $total_price;
          }
        }
        ?>
        <h3>₱. <?php echo $total_completed; ?></h3>
        <p>COMPLETE PAYMENTS TRANSACTIONS</p>
      </div>

      <!-- Order Records -->
      <div class="admin_box">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
        $number_of_orders = mysqli_num_rows($select_orders);
        ?>
        <h3><?php echo $number_of_orders; ?></h3>
        <p>PLACED ORDER RECORDS</p>
      </div>

      <!-- Product Records -->
      <div class="admin_box">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
        $number_of_products = mysqli_num_rows($select_products);
        ?>
        <h3><?php echo $number_of_products; ?></h3>
        <p>ADDED PRODUCTS RECORDS</p>
      </div>

      <!-- Customer Records -->
      <div class="admin_box">
        <?php
        $select_users = mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='user'") or die('query failed');
        $number_of_users = mysqli_num_rows($select_users);
        ?>
        <h3><?php echo $number_of_users; ?></h3>
        <p>CURRENT ONLINE CUSTOMER</p>
      </div>

      <!-- Admin Records -->
      <div class="admin_box">
        <?php
        $select_admin = mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='admin'") or die('query failed');
        $number_of_admin = mysqli_num_rows($select_admin);
        ?>
        <h3><?php echo $number_of_admin; ?></h3>
        <p>SYSTEM ADMINISTRATOR</p>
      </div>

      <!-- Account Records -->
      <div class="admin_box">
        <?php
        $select_accounts = mysqli_query($conn, "SELECT * FROM `register`") or die('query failed');
        $number_of_accounts = mysqli_num_rows($select_accounts);
        ?>
        <h3><?php echo $number_of_accounts; ?></h3>
        <p>TOTAL ACCOUNTS REGISTERED</p>
      </div>

      <!-- Messages Records -->
      <div class="admin_box">
        <?php
        $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        $number_of_messages = mysqli_num_rows($select_messages);
        ?>
        <h3><?php echo $number_of_messages; ?></h3>
        <p>INCOMING MESSAGES RECORDS</p>
      </div>

    </div>

    <!-- Graph Section -->
    <div class="graph-container">
      <canvas id="adminGraph"></canvas>
    </div>

  </section>

  <script src="Admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Example data for the current year (2024)
    const adminData = {
      labels: [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ],
      datasets: [
        {
          label: "2024 Revenue (in PHP)",
          data: [0, 0, 1000, 500, 0, 2000, 1500, 0, 300, 0, 0, 10000], // Low sales; December is ₱10,000
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)", "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)", "rgba(255, 159, 64, 0.2)",
            "rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)", "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)", "rgba(255, 159, 64, 0.2)"
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)", "rgba(255, 159, 64, 1)",
            "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)", "rgba(255, 159, 64, 1)"
          ],
          borderWidth: 1
        }
      ]
    };

    const ctx = document.getElementById('adminGraph').getContext('2d');
    const adminGraph = new Chart(ctx, {
      type: 'line', // Line chart for monthly trends
      data: adminData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          },
          tooltip: {
            enabled: true
          }
        }
      }
    });
  </script>

</body>

</html>