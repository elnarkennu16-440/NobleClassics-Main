<?php
include 'Config.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// The page will show the content even if the user is not logged in

if (isset($_POST['add_to_cart'])) {
  $pro_name = $_POST['product_name'];
  $pro_price = $_POST['product_price'];
  $pro_quantity = $_POST['product_quantity'];
  $pro_image = $_POST['product_image'];

  $check = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$pro_name' AND user_id='$user_id'") or die('query failed');

  if (mysqli_num_rows($check) > 0) {
    $message[] = 'Item is Already Included';
  } else {
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES ('$user_id','$pro_name','$pro_price','$pro_quantity','$pro_image')") or die('query2 failed');
    $message[] = 'Product Successfully Added to Cart';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOBLECLASSICS - OUR BOOKSTORE</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="Home.css">
  <style>
    /* General Body and HTML Settings */
    body,
    html {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    /* Product Box Styling */
    .pro_box {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      width: 250px;
      margin: 20px;
      background-color: rgb(222, 172, 131);
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 10px;
      overflow: hidden;
      opacity: 1;
      transform: none;
      transition: none;
    }

    /* Product Container Styling */
    .pro_box_cont {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    /* Image Styling */
    .pro_box img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
      transition: transform 0.3s ease-in-out;
      /* Smooth zoom effect */
    }

    /* On hover, zoom in the image slightly */
    .pro_box:hover img {
      transform: scale(1.05);
      /* Slight zoom effect */
    }

    /* Hover effects on .pro_box container */
    .pro_box:hover img {
      transform: scale(1.05);
      /* Slight zoom effect */
      transition: transform 0.3s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .pro_box {
        width: 90%;
        /* Wider for smaller screens */
        margin: 10px auto;
      }
    }

    @media (min-width: 769px) {
      .pro_box {
        width: 250px;
        /* Maintain consistent width */
        margin: 20px;
      }
    }

    /* Button Styling */
    .product_btn {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #8f6414;
      border: none;
      color: white;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    /* Hover effect for Add to Cart button */
    .pro_box:hover .product_btn {
      background-color: #a47224;
    }

    /* Title Styling for Product Section */
    .products_cont .title {
      font-size: 2rem;
      color: rgb(79, 24, 35);
      margin-bottom: 20px;
    }

    /* Star Rating System Styling */
    .book-rating {
      font-size: 16px;
      color: rgb(100, 30, 30);
    }

    /* Product Image Link */
    .book-link {
      display: block;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>
  <?php include 'User_Header.php'; ?>

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
  </style>

  <div class="shop_heading"
    style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-flow: column; min-height: 15rem; padding: 2rem; animation: backgroundAnimation 5s infinite;">
    <h3 style="font-size: 5rem; color: white; text-transform: capitalize; margin: 0;">Our Bookstore</h3>
    <p style="font-size: 2.3rem; color: #aaaaaa; margin: 0;">
      <a href="index.php" style="color: #e69969; text-decoration: none;"
        onmouseover="this.style.textDecoration='underline'; this.style.color='white';"
        onmouseout="this.style.textDecoration='none'; this.style.color='#e69969';">Home</a>
      <span> | Bookstore</span>
    </p>
  </div>

  <!-- Display Book Items Outside Modal with Horizontal Star Rating -->
  <section class="products_cont">
    <div class="pro_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
          ?>
          <form action="" method="post" class="pro_box">
            <a href="#" class="book-link" data-title="<?php echo $fetch_products['name']; ?>"
              data-price="<?php echo $fetch_products['price']; ?>"
              data-img="./Book_Images/<?php echo $fetch_products['image']; ?>">
              <img src="./Book_Images/<?php echo $fetch_products['image']; ?>" alt="" loading="lazy">
            </a>
            <h3><?php echo $fetch_products['name']; ?></h3>
            <p>₱. <?php echo $fetch_products['price']; ?></p>

            <!-- Add Rating (Star System) -->
            <div class="book-rating">
              <?php
              $rating = rand(1, 5); // Random rating for demonstration
              for ($i = 0; $i < 5; $i++) {
                if ($i < $rating) {
                  echo '★';  // filled star
                } else {
                  echo '☆';  // empty star
                }
              }
              ?>
            </div>

            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

            <input type="submit" value="Add to Cart" name="add_to_cart" class="product_btn">
          </form>
          <?php
        }
      } else {
        echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Products are Available Yet..</p>';
      }
      ?>
    </div>
  </section>

  <!-- Modal Box (Book Details) -->
  <div id="bookDetailsModal"
    style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); color: #fff; padding: 20px; z-index: 999;">
    <div
      style="max-width: 900px; margin: auto; background: #2b1b03; padding: 20px; border-radius: 10px; overflow: auto; max-height: 90vh;">
      <span id="closeModal"
        style="color: #fff; font-size: 30px; cursor: pointer; position: absolute; top: 20px; right: 20px;">&times;</span>
      <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <img id="bookImage" src="" alt=""
          style="max-width: 300px; max-height: 400px; object-fit: contain; border-radius: 10px; border: 2px solid #fff;">
        <div style="flex: 1; min-width: 250px;">
          <h3 id="bookTitle" style="font-size: 28px; color: #fff; margin-bottom: 10px;"></h3>
          <!-- Removed the bookRating (Star Rating) section -->
          <p id="bookDescription" style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; text-align: justify;">
          </p>
          <p><strong style="font-size: 18px;">Genre:</strong> <span id="bookGenre" style="font-size: 16px;"></span></p>
          <p><strong style="font-size: 18px;">Price:</strong> <span id="bookPrice" style="font-size: 16px;"></span></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Modal functionality for displaying book details
    const bookLinks = document.querySelectorAll('.book-link');
    const modal = document.getElementById('bookDetailsModal');
    const closeModal = document.getElementById('closeModal');
    const bookTitle = document.getElementById('bookTitle');
    const bookDescription = document.getElementById('bookDescription');
    const bookGenre = document.getElementById('bookGenre');
    const bookPrice = document.getElementById('bookPrice');
    const bookImage = document.getElementById('bookImage');

    const GOOGLE_BOOKS_API = "https://www.googleapis.com/books/v1/volumes?q=";

    // When a book is clicked, show its details in the modal
    bookLinks.forEach(link => {
      link.addEventListener('click', async function (event) {
        event.preventDefault();

        const title = this.dataset.title;
        const price = this.dataset.price;
        const imageSrc = this.dataset.img;

        bookTitle.textContent = title;
        bookPrice.textContent = price;
        bookImage.src = imageSrc;

        try {
          const response = await fetch(`${GOOGLE_BOOKS_API}${encodeURIComponent(title)}`);
          const data = await response.json();

          if (data.items && data.items.length > 0) {
            const bookInfo = data.items[0].volumeInfo;
            const fullDescription = bookInfo.description || "Description not available.";

            // Shorten description to 3-5 sentences
            const sentences = fullDescription.split('. ').slice(0, 5).join('. ') + '.';
            bookDescription.textContent = sentences;

            bookGenre.textContent = bookInfo.categories ? bookInfo.categories.join(', ') : "Genre not available.";
          } else {
            bookDescription.textContent = "Description not available.";
            bookGenre.textContent = "Genre not available.";
          }
        } catch (error) {
          console.error("Error fetching book details:", error);
          bookDescription.textContent = "Error fetching description.";
          bookGenre.textContent = "Error fetching genre.";
        }

        // Show the modal
        modal.style.display = 'block';
      });
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', function () {
      modal.style.display = 'none';
    });

    // IntersectionObserver to display product boxes without sliding animation
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        } else {
          entry.target.classList.remove('visible');
        }
      });
    }, { threshold: 0.1 });  // Trigger when 10% of the element is visible

    // Target all product boxes for observing
    const productBoxes = document.querySelectorAll('.pro_box');
    productBoxes.forEach(box => {
      observer.observe(box);
    });

  </script>

  <?php
  include 'Footer.php';
  ?>

</body>

</html>