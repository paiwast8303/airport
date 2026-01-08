<?php 
include 'include/config.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
     $query = "SELECT * FROM `admin` WHERE `Email` = '$email' ";
     $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($count == 1 && $row['statuss'] == 'active' && password_verify($password, $row['passwords']))
    {
        session_start();
        
        $_SESSION['name'] = $row['fname']; 
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['id'];
        header("Location: dashboard.php");
        exit();
    }
    else if ($count == 1 && $row['statuss'] == 'active' && !password_verify($password, $row['passwords']))
    {
      echo "<script>alert('password incorrect');</script>";
    }
    else if ($count == 1 && $row['statuss'] != 'active')
    {
      echo "<script>alert('User is inactive');</script>";
    }
    else
    {
      echo "<script>alert('User not found');</script>";
    }
}


?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Airport Login - Glass Effect</title>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<link rel="stylesheet" href="style/login.css" />
</head>
<body>

    <div class="con">
        <div class="animation">
            <lottie-player
                src="Password Authentication.json"
                background="transparent"
                speed="1"
                loop
                autoplay>
            </lottie-player>
        </div>

        <div>
            <h2>Airport Login</h2>
        </div>
        <form action="index.php" method="POST">
            <label>Username</label>
            <input name="email" type="email" placeholder="Enter your username or ID" required />

            <label>Password</label>
            <input name="password" type="password" placeholder="Enter your password" required />

            <button name="submit" type="submit" class="login-btn">Login </button>
            
        </form>

    </div>

</body>
</html>