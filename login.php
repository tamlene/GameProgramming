<?php
// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $role = $_POST["role"] ?? "";

    // Giả lập kiểm tra tài khoản (bạn có thể thay bằng truy vấn CSDL)
    if ($email && $password && $role) {
        // Ví dụ tạm: đăng nhập thành công
        if ($role === "admin") {
            header("Location: admin/index.php");
            exit;
        } elseif ($role === "user") {
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin và chọn loại tài khoản!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập | HomeDecor</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <style>
    body {
      background-color: #f5f5f5;
    }
    .login {
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      background: #fff;
      padding: 40px 60px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      width: 400px;
      text-align: center;
    }
    .login-container h1 {
      margin-bottom: 25px;
      color: #333;
      font-size: 28px;
    }
    .login-container form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .login-container input,
    .login-container select {
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      font-size: 15px;
      transition: border-color 0.3s;
    }
    .login-container input:focus,
    .login-container select:focus {
      border-color: #d4a017;
    }
    .login-container button {
      padding: 12px;
      border: none;
      background-color: #000;
      color: #fff;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .login-container button:hover {
      background-color: #d4a017;
      color: #000;
    }
    .login-container p {
      margin-top: 15px;
      font-size: 14px;
    }
    .login-container a {
      color: #d4a017;
      text-decoration: none;
    }
    .login-container a:hover {
      text-decoration: underline;
    }
    footer {
      background-color: #000;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    .error {
      color: red;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="container">
      <div class="logo">🏡 <span>HomeDecor</span></div>

      <nav class="main-nav">
        <a href="index.php">Trang chủ</a>
        <a href="about.php">Giới thiệu</a>
        <a href="services.php">Dịch vụ</a>
        <a href="pricing.php">Bảng giá</a>
        <a href="contact.php">Liên hệ</a>
        <a href="faq.php">Hỏi đáp</a>
        <a href="news.php">Tin tức</a>
      </nav>

      <div class="others">
        <input type="text" placeholder="Tìm kiếm..." />
        <i class="fas fa-search"></i>
        <a href="login.php"><i class="fa-regular fa-user"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
    </div>
  </header>

  <!-- LOGIN SECTION -->
  <section class="login">
    <div class="login-container">
      <h1>Đăng nhập hệ thống</h1>
      <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

      <form method="POST" action="">
        <input type="email" name="email" placeholder="Nhập email của bạn" required>
        <input type="password" name="password" placeholder="Nhập mật khẩu" required>

        <select name="role" required>
          <option value="" disabled selected>Chọn loại tài khoản</option>
          <option value="user">Người dùng</option>
          <option value="admin">Quản trị viên</option>
        </select>

        <button type="submit">Đăng nhập</button>
      </form>

      <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>© 2025 HomeDecor. Thiết kế & phát triển bởi nhóm Lập Trình Web.</p>
  </footer>

</body>
</html>
