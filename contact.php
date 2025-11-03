<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liên hệ | HomeDecor</title>

  <!-- External stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <!-- Navigation header component -->
  <?php include 'components/header.php'; ?>

  <!-- Contact form and information section -->
  <section class="contact">
    <div class="container contact-content">
      <h1>Liên hệ với chúng tôi</h1>
      <p>Vui lòng để lại thông tin, chúng tôi sẽ phản hồi sớm nhất có thể 💬</p>

      <form class="contact-form">
        <input type="text" placeholder="Họ và tên" required>
        <input type="email" placeholder="Email" required>
        <textarea placeholder="Nội dung liên hệ" rows="5" required></textarea>
        <button type="submit">Gửi liên hệ</button>
      </form>
    </div>
  </section>

  <!-- Website footer component -->
  <?php include 'components/footer.php'; ?>

  <!-- JavaScript files -->
  <script src="assets/js/script.js"></script>
</body>

</html>