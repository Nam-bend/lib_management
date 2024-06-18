<?php
$conn = mysqli_connect('localhost', 'root', '', 'user_db');
// @include 'config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "QLThongTin_phungdinhtrongnam");
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
    
    $email = $_POST['usermail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    
    $query = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $error = 'Người dùng đã tồn tại';
    } else {
        if ($pass != $cpass) {
            $error = 'Mật khẩu không khớp';
        } else {
            $query = "INSERT INTO user_form (email, password) VALUES ('$email', '$pass')";
            if (mysqli_query($conn, $query)) {
                echo "<p class='message'>Đăng ký thành công</p>";
            } else {
                echo "<p class='error'>Lỗi: " . mysqli_error($conn) . "</p>";
            }
        }
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
    <title>Đăng ký</title>
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
        max-width: 100%;
    }

    .left-panel {
        background-color: #507bc7;
        padding: 30px;
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .left-panel img {
        width: 100%;
        max-width: 300px;
    }

    .left-panel h2 {
        font-size: 24px;
        margin-top: 20px;
    }

    .form-container {
        padding: 30px;
        width: 50%;
    }

    .form-container form .title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .form-container form .box {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-container form .form-btn {
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

    .form-container form .form-btn:hover {
        background-color: #507bc7;
    }

    .form-container form p {
        font-size: 14px;
        color: #555;
    }

    .form-container form p a {
        color: #507bc7;
        text-decoration: none;
    }

    .form-container form .error-msg {
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
    </style>
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <img src="image.png" alt="Image">
            <h2>Thiết lập mật khẩu</h2>
        </div>
        <div class="form-container">
            <form action="" method="POST">
                <h3 class="title">Đăng ký</h3>
                <?php
                if (isset($error)) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ?>
                <input type="email" name="usermail" placeholder="Nhập email" class="box" required>
                <input type="password" name="password" placeholder="Nhập mật khẩu" class="box" required>
                <input type="password" name="cpassword" placeholder="Xác nhận mật khẩu" class="box" required>
                <input type="submit" value="Tiếp tục" class="form-btn" name="submit">
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay!</a></p>
            </form>
        </div>
    </div>
</body>

</html>