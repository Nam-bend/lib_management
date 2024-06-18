<?php

// @include 'config.php';
$conn = mysqli_connect('localhost', 'root', '', 'user_db');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "QLThongTin_phungdinhtrongnam");
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    $email = $_POST['usermail'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['usermail'] = $email;
        header('Location: header.php');
        exit();
    } else {
        $error = 'Email hoặc mật khẩu không chính xác.';
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap">
    <style>
    * {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
    }

    body {
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
    }

    .container {
        display: flex;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 800px;
        /* Đảm bảo độ rộng bằng với form đăng ký */
        max-width: 100%;
    }

    .left-panel {
        padding: 30px;
        width: 50%;
    }

    .left-panel form .title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .left-panel form .box {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .left-panel form .form-btn {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #507bc7;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .left-panel form .form-btn:hover {
        background-color: #507bc7;
    }

    .left-panel form p {
        font-size: 14px;
        color: #555;
    }

    .left-panel form p a {
        color: #507bc7;
        text-decoration: none;
    }

    .left-panel form .error-msg {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        background-color: crimson;
        font-size: 16px;
        color: #fff;
        text-align: center;
        border-radius: 5px;
    }

    .right-panel {
        background-color: #507bc7;
        padding: 30px;
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .right-panel img {
        width: 100%;
        max-width: 300px;
    }

    .right-panel h2 {
        font-size: 24px;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <form action="" method="POST">
                <h3 class="title">Đăng nhập</h3>
                <?php
                if (isset($error)) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ?>
                <input type="email" name="usermail" placeholder="Nhập email" class="box" required>
                <input type="password" name="password" placeholder="Nhập mật khẩu" class="box" required>
                <input type="submit" value="Đăng nhập" class="form-btn" name="submit">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay!</a></p>
            </form>
        </div>
        <div class="right-panel">
            <img src="image.png" alt="Image">
            <h2>Chào mừng trở lại!</h2>
        </div>
    </div>
</body>

</html>