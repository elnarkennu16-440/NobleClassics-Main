<?php
include 'Config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:Login.php');
}

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `register` WHERE id='$delete_id'");
  $message[]='1 user has been deleted';
  header("location:Admin_Users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRATOR - ACCOUNTS</title>
  <link rel="stylesheet" href="Admin.css">
  <link rel="stylesheet" href="Style.css">
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

    .admin_users h1 {
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

    .admin_users h1 i {
      margin-right: 10px; /* Space between the icon and text */
      font-size: 1.8rem;
      color: #fdc5a1;
    }
  </style>


<?php
include 'Admin_Header.php';
?>

<section class="admin_users">
<h1 class="title"><i class="fa-solid fa-users"></i>USER ACCOUNTS</h1>
  <div class="admin_box_container">
    <?php
      $select_users=mysqli_query($conn,"SELECT * FROM `register`");

      while($fetch_users=mysqli_fetch_assoc($select_users)){

    ?>
    <div class="admin_box" style="background:#3f093a; border-radius: 30px; width: fit-content; height: 400px; margin-top: 20px;">
      <p style="color:aliceblue; margin-bottom: 20px;">Username : <span style="color:blanchedalmond"><?php echo $fetch_users['name']?></span></p>
      <p style="color:aliceblue; margin-bottom: 20px;">Email : <span style="color:blanchedalmond"><?php echo $fetch_users['email']?></span></p>
      <p style="color:aliceblue;">Account Type : <span style="color:<?php if($fetch_users['user_type']=='admin'){echo '#ba6aff';}else{echo '#dca864';}?>"><?php echo $fetch_users['user_type']?></span></p>
      <a href="Admin_Users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn" style="background:#62318d; border-radius: 10px; margin-top: 200px;" onmouseover="this.style.background='#3b1a73';" onmouseout="this.style.background='#62318d';">Delete Account</a>

    </div>
      <?php
        };
      ?>
    
  </div>
</section>



<script src="Admin.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>