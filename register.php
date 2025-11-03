<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng ký | HomeDecor</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- HEADER -->
  <?php include 'components/header.php'; ?>

  <!-- REGISTER FORM -->
  <section class="register">
    <div class="container">
      <h1>Đăng ký tài khoản</h1>
      <form action="controllers/userController.php" method="POST">
        <input type="text" name="name" placeholder="Họ và tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit" name="register">Đăng ký</button>
      </form>
      <p>Đã có tài khoản? <a href="login.html">Đăng nhập</a></p>
    </div>
  </section>

  <!-- FOOTER -->
  <?php include 'components/footer.php'; ?>
</body>
</html>
