<?php
include 'Config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:Login.php');
};

if(isset($_POST['add_products_btn'])){
  $name=mysqli_real_escape_string($conn, $_POST['name']);
  $price=$_POST['price'];
  $image=$_FILES['image']['name'];
  $image_size=$_FILES['image']['size'];
  $image_tmp_name=$_FILES['image']['tmp_name'];
  $image_folder="Book_Images/".$image;

  $select_product_name=mysqli_query($conn, "SELECT name FROM `products` WHERE name='$name'") or die('query failed');

  if(mysqli_num_rows($select_product_name)>0){
    $message[]='The given product is already added';
  }else{
    $add_product_query=mysqli_query($conn,"INSERT INTO `products`(name,price,image) VALUES ('$name','$price','$image')") or die('query2 failed');
    if($add_product_query){
      if($image_size>2000000){
        $message[]='Image size is too large';
      }else{
        move_uploaded_file($image_tmp_name,$image_folder);
        $message[]="Product added successfully!";
      }
    }else{
      $message[]="Product failed to be added!";
    }
  }
};

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];

  $delete_img_query=mysqli_query($conn,"SELECT image from `products` WHERE id='$delete_id'") or die('query failed');
  $fetch_del_img=mysqli_fetch_assoc($delete_img_query);
  unlink('./Book_Images/'.$fetch_del_img);

  mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
  header('location:Admin_Products.php');
}

if(isset($_POST['update_product'])){
  $update_p_id=$_POST['update_p_id'];
  $update_name=$_POST['update_name'];
  $update_price=$_POST['update_price'];

  mysqli_query($conn,"UPDATE `products` SET name='$update_name', price='$update_price' WHERE id='$update_p_id'") or die('query failed');

  $update_image=$_FILES['update_image']['name'];
  $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
  $update_image_size=$_FILES['update_image']['size'];
  $update_folder='./Book_Images/'.$update_image;
  $old_image=$_POST['update_old_img'];
  if(!empty($update_image)){
    if($update_image_size>2000000){
      $message[]='Image size is too large';
    }else{
      mysqli_query($conn,"UPDATE `products` SET image='$update_image' WHERE id='$update_p_id'") or die('query failed');

      move_uploaded_file($update_image_tmp_name,$update_folder);
      unlink('./Book_Images/'.$old_image);

      $message[]="Product added successfully!";
    }
  }
  header('location:Admin_Products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRATOR - PRODUCTS</title>
  <link rel="stylesheet" href="Admin.css">
  <link rel="stylesheet" href="Style.css">
  <link rel="stylesheet" href="https://kit.fontawesome.com/eedbcd0c96.css" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to left, #33164c, #3d2606); background-size: 300% 300%; animation: gradientShift 5s ease infinite;">

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

    .admin_add_products h3 {
      animation: slideIn 1s ease-out;
    }

    .admin_add_products form {
      background: linear-gradient(to left, #c27cff, #ffcb82);
      border-radius: 40px;
      padding: 40px;
      width: 60%;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Make the form responsive */
    @media screen and (max-width: 768px) {
      .admin_add_products form {
        width: 90%;
        padding: 20px;
      }

      .admin_add_products h3 {
        font-size: 1.5rem;
      }

      .admin_input {
        width: 100%;
        padding: 12px;
      }
    }

    /* For very small screens like phones in portrait mode */
    @media screen and (max-width: 480px) {
      .admin_add_products form {
        width: 100%;
        padding: 15px;
      }

      .admin_add_products h3 {
        font-size: 1.2rem;
      }
    }
  </style>

<?php
include 'Admin_Header.php';
?>

<section class="admin_add_products">
  <form action="" method="post" enctype="multipart/form-data">
    <h3 style="color: #1d1157; margin-bottom: 20px;">
      <i class="fas fa-book" style="margin-right: 10px;"></i> <!-- Add icon here -->
      Input Product Item
    </h3>
    <input type="text" name="name" class="admin_input" placeholder="Enter Product Name" required>
    <input type="number" min="0" name="price" class="admin_input" placeholder="Enter Product Price" required>
    <input type="file" name="image" class="admin_input" accept="image/jpg, image/jpeg, image/png" required>
    <input type="submit" name="add_products_btn" class="admin_input" value="Add Your Product" 
      style="background: #2c0f46; color: white; border: none; padding: 10px 20px; border-radius: 15px; cursor: pointer;" 
      onmouseover="this.style.background='#8367c7'; this.style.color='#000';" 
      onmouseout="this.style.background='#2c0f46'; this.style.color='#fff';">
  </form>
</section>

<section class="show_products">
  <div class="product_box_cont">
    <?php
      $select_products=mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');

      if(mysqli_num_rows($select_products)>0){
        while($fetch_products=mysqli_fetch_assoc($select_products)){
    ?>

    <div class="product_box">
      <img src="./Book_Images/<?php echo $fetch_products['image'];?>" alt="">

      <div class="product_name">
      <?php echo $fetch_products['name'];?>
      </div>

      <div class="product_price" style="color:#1d1157;">₱. 
      <?php echo $fetch_products['price'];?> 
      </div>

      <a href="Admin_Products.php?update=<?php echo $fetch_products['id']?>" class="product_btn" style="background: #53431f;">Update</a>

      <a href="Admin_Products.php?delete=<?php echo $fetch_products['id']?>" class="product_btn product_del_btn" onclick= "return confirm('Are you sure you want to delete this product?');" style="background:#2c0f46;">Delete</a>
    </div>
    <?php
      }
    }else{
      echo '<p class="empty" style="padding: 1rem; text-align: center; background: linear-gradient(to bottom, #29113b, #34240b); color: #fdc5a1; font-size: 1.5rem; font-weight: bold; width: fit-content; margin: 0 auto; margin-bottom: 20px; margin-top: 30px; border-radius: 20px; box-shadow: 0px 4px 10px white;">No Products are Available yet..</p>';
    }
    ?>
  </div>
</section>

<section class="edit_product_form">
  <?php
    if(isset($_GET['update'])){
      $update_id=$_GET['update'];
      $update_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$update_id'") or die('query failed');
      if(mysqli_num_rows($update_query)>0){
        while($fetch_update=mysqli_fetch_assoc($update_query)){
  ?>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'];?>">

    <input type="hidden" name="update_old_img" value="<?php echo $fetch_update['image'];?>">

    <img src="./Book_Images/<?php echo $fetch_update['image'];?>" alt="">

    <input type="text" name="update_name" value="<?php echo $fetch_update['name'];?>" class="admin_input update_box" required placeholder="Enter Product Name">

    <input type="number" name="update_price" min="0" value="<?php echo $fetch_update['price'];?>" class="admin_input update_box" required placeholder="Enter Product Price">

    <input type="file" name="update_image" value="<?php echo $fetch_update['price'];?>" class="admin_input update_box" accept="image/jpg, image/jpeg, image/png">

    <input type="submit" value="update" name="update_product" class="product_btn">
    <input type="reset" value="cancel" id="close_update" class="product_btn product_del_btn">
    
  </form>

  <?php
      }
    }
  }else{
    echo "<script>
    document.querySelector('.edit_product_form').style.display='none';
    </script>";
  }
  ?>

</section>

<script src="Admin.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>
