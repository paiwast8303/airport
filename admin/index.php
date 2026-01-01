<?php 
include 'include/config.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
     

     $query = "SELECT * FROM `admin` WHERE `Email` = '$email' AND `passwords` = '$password'";

     $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1  && $row['role'] != 'Staff')
    {
        
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['fname']; 
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php");
        exit();
      
    }
    else
    {
         echo "<script>alert('Invalid $count');</script>";

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