<?php
include 'Config.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// The page will show the content even if the user is not logged in

if (isset($_POST['add_to_cart'])) {
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

  if (mysqli_num_rows($check_cart_numbers) > 0) {
    $message[] = 'Already Added to Cart!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    $message[] = 'Product Added to Cart!';
  }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOBLECLASSICS-SEARCH</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">

  <style>
    /* Ensure the body takes the full height of the viewport */
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    body {
      flex: 1;
    }

    .search-form {
      margin-top: 20px;
      margin-left: 30px;
    }

    /* Responsive search bar */
    .search-form form {
      display: flex;
      gap: 0.8rem;
      align-items: center;
      margin-top: 20px;
    }

    .search-form input[type="text"] {
      background: #fad1b2;
      width: 100%;
      max-width: 1300px;
      padding: 0.8rem;
      font-size: 1rem;
      border: 1px solid white;
      border-radius: 30px;
      color: #333;
      outline: none;
    }

    .search-form button {
      width: 50px;
      height: 50px;
      background-color: #2b1b03;
      color: #fff;
      cursor: pointer;
      font-size: 1.2rem;
      border: none;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      outline: none;
    }

    /* Mobile responsiveness for search form */
    @media (max-width: 768px) {
      .search-form form {
        gap: 0.5rem;
        margin-left: 10px;
      }

      .search-form input[type="text"] {
        padding: 0.6rem;
        font-size: 0.9rem;
      }

      .search-form button {
        width: 40px;
        height: 40px;
      }
    }

    /* Adjustments for product listings and footer */
    .products_cont {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 30px;
      flex: 1; /* Allow this section to take up remaining space */
    }

    .pro_box_cont {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }

    .product_btn {
      padding: 10px 20px;
      background-color: #514702;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgb(193, 234, 255);
      font-weight: 900;
      cursor: pointer;
    }

    /* Footer responsiveness */
    .footer {
      padding: 20px;
      background-color: #f1f1f1;
      text-align: center;
      margin-top: auto; /* Push footer to the bottom */
    }

    @media (max-width: 768px) {
      .footer {
        padding: 15px;
      }
    }

    /* For smaller devices */
    @media (max-width: 480px) {
      .footer {
        padding: 10px;
      }
    }
  </style>
</head>

<body>

  <?php
  include 'User_Header.php';
  ?>

  <section class="search-form">
    <form method="post" action="">
      <input type="text" name="search_box" placeholder="Search Products here..." />
      <button type="submit" name="search_btn">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </section>

  <section class="products_cont">
    <div class="pro_box_cont">
      <?php
      if (isset($_POST['search_btn'])) {
        $search_item = $_POST['search_box'];
        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
          while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
            <form action="" method="post" class="pro_box">
              <img src="./Book_Images/<?php echo $fetch_products['image']; ?>" alt="">
              <h3><?php echo $fetch_products['name']; ?></h3>
              <p>₱. <?php echo $fetch_products['price']; ?></p>

              <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
              <input type="number" name="product_quantity" min="1" value="1">
              <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
              <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

              <input type="submit" value="Add to Cart" name="add_to_cart" class="product_btn">
            </form>
      <?php
          }
        } else {
          echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Matching Products Found!</p>';
        }
      } else {
        echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">Search For Classic Literature..</p>';
      }
      ?>
    </div>
  </section>

  <?php
  include 'Footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
  <script src="Script.js"></script>

</body>

</html>
