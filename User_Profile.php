<?php
session_start();
include 'Config.php';

if (!isset($_SESSION['user_id'])) {
    header('location: Login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$query = "SELECT * FROM `register` WHERE id='$user_id'";
$result = mysqli_query($conn, $query) or die('Query failed');
$user_data = mysqli_fetch_assoc($result);

// Handle profile updates
if (isset($_POST['update_profile'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $home_address = mysqli_real_escape_string($conn, $_POST['home_address']);

    $update_query = "UPDATE `register` SET phone='$phone', home_address='$home_address' WHERE id='$user_id'";
    mysqli_query($conn, $update_query) or die('Query failed');
    $message = "Profile updated successfully!";
    header('Refresh: 0'); // Refresh the page to show updated details
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('Display_Images/Classic_Background_Image.jpg') no-repeat center center/cover;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px)
        }

        .header {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color:rgb(101, 59, 20);
        }

        .profile-container {
            background: linear-gradient(to right,rgb(135, 73, 66),rgb(243, 200, 94));
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 400px;
        }

        .profile-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 2px solid #874942;
        }

        .profile-container h2 {
            margin: 10px 0;
            margin-bottom: 20px;
            font-size: 28px;
            color:rgb(85, 49, 21);
            font-family: 'Courier New', Courier, monospace;
        }

        .profile-container p {
            margin: 5px 0;
            color: beige;
            font-weight: bold;
            font-size: 15px;
        }

        .profile-container input[type="text"],
        .profile-container textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid orange;
            background-color:rgb(143, 67, 59);
            font-weight: bold;
            color:rgb(255, 204, 165);
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Courier New', Courier, monospace;
        }

        .edit-button,
        .save-button {
            background: #8b4611;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: fixed;
        }

        .edit-button:hover,
        .save-button:hover {
            background: rgb(81, 45, 9);
        }

        .back-button {
            margin-top: 15px;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            display: inline-block;
            background: #8b4611;
            color: #fff;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 10px;
        }

        .back-button:hover {
            background:rgb(51, 27, 8);
        }

        .message {
            color: orangered;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .input-email-container p {
    display: inline-block;
    text-align: center;
    color: darksalmon !important;
    font-size: 16px;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 40px !important;
    border-radius: 10px;
    background-color:rgb(94, 49, 16);
    border: 1px solid #caa080;  /* Add a border around the text */
    padding: 5px;  /* Optional: Adjust padding for spacing between text and border */
}

.input-email-container {
    display: inline-block;  /* Optional: Ensures that the container is tightly wrapped around the paragraph */
}


        .input-container {
            display: flex;
            color:  #94582a;
            font-size: 40px;
            align-items: center;
            margin-bottom: 20px;
        }

        .input-container input {
            width: calc(100% - 100px);
            /* Ensure input doesn't stretch too wide */
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="header">𝙽𝚘𝚋𝚕𝚎 𝙲𝚕𝚊𝚜𝚜𝚒𝚌𝚜</div>

        <?php if (!empty($user_data['profile_picture'])): ?>
            <img src="<?= $user_data['profile_picture']; ?>" alt="Profile Picture">
        <?php else: ?>
            <img src="Icons/user_icon.png" alt="Default Profile Picture">
        <?php endif; ?>

        <h2><?= $user_data['name']; ?></h2>

        <div class="input-email-container">
            <p>Email Address:</p>
            <p><?= $user_data['email']; ?></p>
        </div>

        <form action="" method="POST">
            <div class="input-container">
                <input type="text" name="phone" placeholder="Phone Number" value="<?= $user_data['phone']; ?>">
                <button type="submit" class="edit-button">Edit</button>
            </div>

            <div class="input-container">
                <textarea name="home_address" placeholder="Home Address"><?= $user_data['home_address']; ?></textarea>
                <button type="submit" class="edit-button">Edit</button>
            </div>

            <div class="input-container">
                <button type="submit" name="update_profile" class="save-button">Save Changes</button>
            </div>
        </form>

        <?php if (isset($message)): ?>
            <p class="message"><?= $message; ?></p>
        <?php endif; ?>

        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>

</html>