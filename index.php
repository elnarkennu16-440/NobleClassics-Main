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

  $check = mysqli_query($conn, "SELECT * FROM `cart` where name='$pro_name' and user_id='$user_id'") or die('query failed');

  if (mysqli_num_rows($check) > 0) {
    $message[] = 'Already Added to Cart!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart`(user_id,name,price,quantity,image) VALUES ('$user_id','$pro_name','$pro_price','$pro_quantity','$pro_image')") or die('query2 failed');
    $message[] = 'Product Added to Cart!';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOBLECLASSICS - HOME</title>

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
  <style>
    @keyframes slide-in {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }

      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .slide {
      opacity: 0;
      /* Start invisible */
      transform: translateX(-100%);
      /* Start offscreen */
      transition: opacity 1s ease-out, transform 1s ease-out;
      /* Apply a smooth transition */
    }

    .slide-in {
      animation: slide-in 1s ease-out forwards;
      /* Slide-in animation */
    }

    .title {
      padding: 1rem;
      text-align: center;
      background: linear-gradient(to left, #dbaa61, #9b8053);
      font-size: 2rem;
      font-weight: bold;
      width: fit-content;
      margin: 0 auto;
      margin-bottom: 2.5rem;
      border-radius: 20px;
      box-shadow: 0px 4px 10px white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      /* Ensure there is no underline */
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow-x: hidden;
      /* Prevent horizontal scroll */
    }

    .home_cont {
      width: 100%;
      height: 95vh;
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("Display_Images/ClassicBooksBG.png") no-repeat;
      background-size: cover;
      display: flex;
      align-items: center;
      padding: 0 2rem;
      /* Add padding for alignment */
    }

    .home_cont .main_descrip {
      text-align: left;
      /* Align text to the left */
      max-width: 50%;
      /* Limit width for better responsiveness */
    }

    .home_cont .main_descrip h1 {
      font-size: 4rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: white;
    }

    .home_cont .main_descrip p {
      font-size: 1.5rem;
      font-weight: 500;
      letter-spacing: 1px;
      color: white;
    }

    .home_cont .main_descrip button {
      margin: 1rem;
      padding: 1rem 2rem;
      background-color: #ebae69;
      border: none;
      font-size: 1.2rem;
      font-weight: 600;
      letter-spacing: 1px;
      border-radius: 30px;
      margin-top: 30px;
      box-shadow: 2px 2px 10px rgb(213, 194, 108);

    }

    .home_cont .main_descrip button:hover {
      background-color: #8f6414;
      color: #f7c073;
    }

    .home_cont .home_image {
      max-width: 35%;
      /* Limit image container size */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .home_cont .home_image img {
      max-width: 100%;
      height: auto;
      /* Maintain aspect ratio */
      border-radius: 10px;
      /* Add subtle rounding */
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
      /* Add shadow for aesthetics */
    }

    .about_cont {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 4rem 2rem;
      flex-wrap: wrap;
    }

    .about_cont img {
      max-width: 45%;
      /* Image takes up 45% of the container */
      height: auto;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
      margin-right: 2rem;
      /* Adds space between the image and text */
    }

    .about_descript {
      max-width: 45%;
      /* Text takes up 45% of the container */
    }

    .about_descript h2 {
      font-family: 'Lato', sans-serif;
      font-size: 32px;
      font-weight: bold;
      font-style: italic;
      margin-bottom: 1rem;
    }

    .about_descript p {
      font-size: 1.2rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    /* Star Rating System Styling */
    .book-rating {
      font-size: 16px;
      color: rgb(100, 30, 30);
    }


    /* Add this CSS to your existing styles */

    /* Apply a zoom-in effect to the product images */
    .products_cont .pro_box img {
      transition: transform 0.3s ease-in-out;
      /* Smooth transition for zoom effect */
      border-radius: 10px;
      /* Optional: Make the image corners rounded for aesthetic appeal */
    }

    /* On hover, zoom in the image slightly */
    .products_cont .pro_box img:hover {
      transform: scale(1.1);
      /* Zoom effect, adjust the scale value to your preference */
    }



    /* Responsiveness */
    @media (max-width: 768px) {
      .about_cont {
        flex-direction: column;
        text-align: center;
      }

      .about_cont img {
        max-width: 80%;
        /* Image takes up more space on smaller screens */
        margin-bottom: 2rem;
      }

      .about_descript {
        max-width: 80%;
        /* Text container becomes wider */
      }
    }
  </style>

  <section class="home_cont">
    <div class="main_descrip">
      <h1 style="color:antiquewhite;">Enjoy Timeless Classics</h1>
      <p>Best Noble Deals, You're Choice, You're Click</p>
      <button onclick="window.location.href='Shop_System.php';">SHOP NOW!</button>
    </div>
    <div class="home_image">
      <img src="Display_Images/classic-literature-display.png" alt="Decorative Image">
    </div>
  </section>


  <section class="products_cont">
    <h1 class="title slide"><i class="fa fa-book" style="margin-right: 10px;"></i> Our Latest Products
    </h1>
    <div class="pro_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

          ?>
          <form action="" method="post" class="pro_box">
            <img src="./Book_Images/<?php echo $fetch_products['image']; ?>" alt=""
              onclick="showModal('<?php echo $fetch_products['name']; ?>', '<?php echo $fetch_products['price']; ?>', '<?php echo $fetch_products['image']; ?>')">
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

  <section class="about_cont">
    <img src="Display_Images/About.png" alt="">
    <div class="about_descript">
      <h2 style="font-family: 'Lato', sans-serif; font-size:32px; font-weight: bold; font-style: italic;">Discover
        NobleClassics</h2>
      <p>At NobleClassics, we are passionate about connecting readers with captivating stories, inspiring ideas, and a
        world of knowledge. Our bookstore is more than just a place to buy books; it's a haven for book enthusiasts,
        where the love for literature thrives.
      </p>
      <button class="product_btn" onclick="window.location.href='About.php';">Read More</button>
    </div>
  </section>


  <section class="carousel_cont">
    <h1 class="title slide"> <i class="fa fa-book" style="margin-right: 10px;"></i> Top Selling Products
    </h1>

    <div class="carousel">
      <div class="carousel_track-container">
        <ul class="carousel_track">
          <?php
          // Fetch 10 book images from the database
          $select_books = mysqli_query($conn, "SELECT image FROM `products` LIMIT 10") or die('query failed');
          if (mysqli_num_rows($select_books) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_books)) {
              echo '<li class="carousel_slide"><img src="./Book_Images/' . $fetch_books['image'] . '" alt="Book Cover"></li>';
            }
          } else {
            // Display a placeholder if no books are found
            echo '<li class="carousel_slide"><img src="placeholder-image.jpg" alt="Placeholder"></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </section>


  <section class="questions_cont">
    <div class="questions">
      <h2 style="font-family: 'Lato', sans-serif; font-size:30px; font-weight: bold;font-style: italic;">Queries?</h2>
      <p>At NobleClassics, we value your satisfaction and strive to provide exceptional customer service. If you have
        any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
      <button class="product_btn" onclick="window.location.href='Contact.php';">Contact Us</button>
    </div>

  </section>


  <?php
  include 'Footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

  <script src="Script.js"></script>

  <script>
    const track = document.querySelector('.carousel_track');
    const slides = Array.from(track.children);
    const slideWidth = slides[0].getBoundingClientRect().width;

    const numSlides = slides.length;

    // Arrange the slides next to one another
    const setSlidePosition = (slide, index) => {
      slide.style.left = slideWidth * index + 'px';
    };
    slides.forEach(setSlidePosition);


    const moveToSlide = (track, currentSlide, targetSlide) => {
      track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
      currentSlide.classList.remove('current-slide');
      targetSlide.classList.add('current-slide');

    }

    // Clone the first and last slides for seamless looping
    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[numSlides - 1].cloneNode(true);

    // Append the first clone after the last slide and prepend the last clone before the first slide
    slides[numSlides - 1].after(firstClone);
    slides[0].before(lastClone);

    // Update slides array and re-position
    slides.push(firstClone);
    slides.unshift(lastClone);
    slides.forEach(setSlidePosition);

    // Set initial position to the first actual slide (not the clone)
    const initialSlide = slides[1];
    track.style.transform = 'translateX(-' + initialSlide.style.left + ')';
    initialSlide.classList.add('current-slide');

    let slideInterval;
    function startSlider() {
      slideInterval = setInterval(() => {
        const currentSlide = track.querySelector('.current-slide');
        let nextSlide = currentSlide.nextElementSibling;

        // Apply the transition effect before moving to the next slide
        track.style.transition = 'transform 500ms ease-in-out';
        moveToSlide(track, currentSlide, nextSlide);

        if (nextSlide === firstClone) {
          // If sliding to the cloned first slide:
          setTimeout(() => {
            nextSlide = slides[1]; // Target the actual first slide
            track.style.transition = 'none'; // Remove transition to prevent jump
            moveToSlide(track, firstClone, nextSlide); // Jump to the actual first slide
            track.getBoundingClientRect(); // Force reflow
            track.style.transition = 'transform 500ms ease-in-out'; // Re-apply transition
          }, 500); // Wait for the transition to complete

        } else if (currentSlide === lastClone) {
          // If current slide is the cloned last slide:
          setTimeout(() => {
            nextSlide = slides[numSlides]; // Target the cloned first slide
            track.style.transition = 'none'; // Remove transition to prevent jump
            moveToSlide(track, slides[0], nextSlide); // Jump to the cloned first slide
            track.getBoundingClientRect(); // Force reflow
            track.style.transition = 'transform 500ms ease-in-out'; // Re-apply transition
          }, 500); // Wait for the transition to complete
        }
      }, 2000);
    }

    startSlider(); // Start the slider

    // Function to add sliding animation when elements come into view
    function handleScroll() {
      const elements = document.querySelectorAll('.slide');
      const windowHeight = window.innerHeight;

      elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;

        // If the element is in the viewport, add the 'slide-in' class
        if (elementTop <= windowHeight * 0.8) {
          element.classList.add('slide-in');
        }
      });
    }

    // Call the function on scroll
    window.addEventListener('scroll', handleScroll);

    // Optionally, you can trigger it when the page first loads to handle elements already in view
    handleScroll();

    const loginButtons = document.querySelectorAll('.check-login');

    loginButtons.forEach(button => {
      button.addEventListener('click', function (event) {
        // Check if the user is logged in
        const userLoggedIn = <?php echo json_encode($user_id !== null); ?>;

        if (!userLoggedIn) {
          // Display the message and redirect to login page
          alert("Please Login to access our website");
          window.location.href = 'login.php'; // Redirect to login page
        } else {
          // If the user is logged in, proceed to the intended page
          window.location.href = button.getAttribute('data-href');
        }
      });
    });

  </script>

  <!-- Modal Box (Book Details) -->
  <div id="bookDetailsModal"
    style="display:none; position: fixed; top: 10%; left: 0; width: 100%; height: auto; background: rgba(0, 0, 0, 0.7); color: #fff; padding: 20px; z-index: 999;">
    <div
      style="max-width: 900px; margin: auto; background: #2b1b03; padding: 20px; border-radius: 10px; overflow: hidden; max-height: 80vh; position: relative;">
      <span id="closeModal"
        style="color: #fff; font-size: 30px; cursor: pointer; position: absolute; top: 20px; right: 20px; z-index: 1000;">&times;</span>
      <div style="display: flex; flex-wrap: wrap; gap: 20px; overflow-y: auto; max-height: 70vh;">
        <img id="bookImage" src="" alt=""
          style="max-width: 300px; max-height: 400px; object-fit: contain; border-radius: 10px; border: 2px solid #fff;">
        <div style="flex: 1; min-width: 250px; overflow-y: auto;">
          <h3 id="bookTitle" style="font-size: 28px; color: #fff; margin-bottom: 10px;"></h3>
          <p id="bookDescription" style="font-size: 16px; line-height: 1.6; margin-bottom: 20px; text-align: justify;">
          </p>
          <p><strong style="font-size: 18px;">Genre:</strong> <span id="bookGenre" style="font-size: 16px;"></span></p>
          <p><strong style="font-size: 18px;">Price:</strong> <span id="bookPrice" style="font-size: 16px;"></span></p>
        </div>
      </div>
    </div>
  </div>


  <style>
    @media (max-width: 768px) {
      #bookDetailsModal {
        padding: 10px;
        /* Less padding for smaller screens */
        overflow-y: hidden;
        /* Hide overflow on modal container */
      }

      #bookDetailsModal>div {
        width: 100%;
        /* Full width for smaller devices */
        padding: 10px;
        /* Adjust padding */
        max-height: 90vh;
        /* Limit the height of the modal */
        overflow: hidden;
        /* Ensure no overflow on the outer container */
        position: relative;
      }

      #bookImage {
        max-width: 100%;
        /* Ensure the image fits smaller screens */
        max-height: 300px;
        /* Adjust height */
      }

      #bookTitle {
        font-size: 24px;
        /* Slightly smaller title for mobile */
      }

      #bookDescription {
        font-size: 14px;
        /* Adjust font size for better readability on mobile */
        line-height: 1.4;
        overflow-y: auto;
        /* Allow the description to scroll if it's too long */
        max-height: 300px;
        /* Limit description height to make room for scrolling */
      }

      /* Inner content flex box should also be scrollable */
      #bookDetailsModal>div>div {
        max-height: 70vh;
        /* Allow the inner content (image + text) to scroll */
        overflow-y: auto;
      }
    }
  </style>




  <script>
    // Function to show the modal with product details
    async function showModal(title, price, imageSrc) {
      const modal = document.getElementById('bookDetailsModal');
      const bookTitle = document.getElementById('bookTitle');
      const bookDescription = document.getElementById('bookDescription');
      const bookGenre = document.getElementById('bookGenre');
      const bookPrice = document.getElementById('bookPrice');
      const bookImage = document.getElementById('bookImage');

      bookTitle.textContent = title;
      bookPrice.textContent = "₱" + price;
      bookImage.src = "./Book_Images/" + imageSrc;

      // Default content before API data is fetched
      bookDescription.textContent = "Loading description...";
      bookGenre.textContent = "Loading genre...";

      // Google Books API endpoint for fetching book details
      const GOOGLE_BOOKS_API = "https://www.googleapis.com/books/v1/volumes?q=";

      try {
        // Fetch data from Google Books API
        const response = await fetch(`${GOOGLE_BOOKS_API}${encodeURIComponent(title)}`);
        const data = await response.json();

        if (data.items && data.items.length > 0) {
          const bookInfo = data.items[0].volumeInfo;

          // Get the full description, ensuring it's not too long
          let fullDescription = bookInfo.description || "Description not available.";

          // Limit the description to a more balanced length (e.g., 300 characters max)
          if (fullDescription.length > 300) {
            fullDescription = fullDescription.slice(0, 300) + '...';
          }

          bookDescription.textContent = fullDescription;

          // Set the genre, if available
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
    }

    // Close the modal when the close button is clicked
    const closeModal = document.getElementById('closeModal');
    closeModal.addEventListener('click', function () {
      const modal = document.getElementById('bookDetailsModal');
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

</body>

</html>