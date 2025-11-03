<?php
// Lấy ID bài viết từ URL (giả lập)
$id = $_GET['id'] ?? 1;

// Giả lập dữ liệu bài viết (sau này có thể thay bằng dữ liệu từ CSDL)
$newsList = [
  1 => [
    "title" => "Phong cách Scandinavian – Tối giản nhưng tinh tế",
    "date" => "20/10/2025",
    "img" => "assets/img/news1.jpg",
    "content" => "
      <p>Phong cách Scandinavian (Bắc Âu) đang trở thành xu hướng được ưa chuộng trong thiết kế nội thất hiện đại.
      Sự kết hợp hoàn hảo giữa <b>tối giản</b>, <b>ấm áp</b> và <b>tinh tế</b> mang đến một không gian sống nhẹ nhàng, dễ chịu
      nhưng vẫn sang trọng và đầy cảm xúc.</p>

      <h2>1. Màu sắc chủ đạo</h2>
      <p>Gam màu trắng, xám, be và gỗ sáng là những yếu tố đặc trưng trong phong cách này. Chúng giúp phản chiếu ánh sáng,
      làm căn phòng trở nên rộng rãi và sáng sủa hơn.</p>

      <h2>2. Chất liệu sử dụng</h2>
      <p>Scandinavian ưa chuộng chất liệu tự nhiên như gỗ, len, vải thô và da. Chúng không chỉ tạo cảm giác gần gũi mà còn
      thể hiện sự bền vững và thân thiện môi trường.</p>

      <h2>3. Bí quyết trang trí</h2>
      <p>Hạn chế tối đa đồ nội thất, ưu tiên các chi tiết đơn giản và có tính ứng dụng cao. Một chiếc ghế bành nhỏ, tấm thảm
      len và đèn bàn thiết kế tinh tế là đủ để tạo nên điểm nhấn.</p>

      <img src='assets/img/scandinavian-detail.jpg' alt='Không gian Scandinavian' class='article-image' />

      <p>HomeDecor hy vọng bài viết này sẽ giúp bạn có thêm cảm hứng để trang trí không gian sống của mình theo phong cách
      Bắc Âu — nơi mọi thứ đều hướng đến sự <b>đơn giản, tự nhiên và thanh lịch</b>.</p>
    "
  ],
  2 => [
    "title" => "Xu hướng nội thất 2025 – Tự nhiên & Bền vững",
    "date" => "18/10/2025",
    "img" => "assets/img/news2.jpg",
    "content" => "
      <p>Vật liệu thân thiện môi trường đang trở thành xu hướng chính trong ngành nội thất năm 2025. Gỗ tái chế, đá tự nhiên,
      và vật liệu hữu cơ giúp không gian vừa hiện đại vừa bền vững.</p>
    "
  ],
  3 => [
    "title" => "5 gợi ý giúp phòng khách nhỏ trở nên rộng hơn",
    "date" => "10/10/2025",
    "img" => "assets/img/news3.jpg",
    "content" => "
      <p>Sử dụng gương, ánh sáng và màu sắc hợp lý giúp căn phòng nhỏ trở nên thoáng đãng và dễ chịu hơn rất nhiều.</p>
    "
  ]
];

$article = $newsList[$id] ?? $newsList[1];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($article['title']); ?> | HomeDecor</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- CSS chung -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- CSS riêng -->
  <link rel="stylesheet" href="assets/css/news_detail.css" />
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
        <a href="news.php" class="active">Tin tức</a>
      </nav>

      <div class="others">
        <input type="text" placeholder="Tìm kiếm..." />
        <i class="fas fa-search"></i>
        <a href="login.php"><i class="fa-regular fa-user"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
    </div>
  </header>

  <!-- HERO BÀI VIẾT -->
  <section class="article-hero" style="background-image: url('<?php echo $article['img']; ?>');">
    <div class="overlay">
      <h1><?php echo htmlspecialchars($article['title']); ?></h1>
      <p><i class="fa-regular fa-calendar"></i> <?php echo $article['date']; ?></p>
    </div>
  </section>

  <!-- NỘI DUNG BÀI VIẾT -->
  <main class="article container">
    <?php echo $article['content']; ?>
  </main>

  <!-- BÀI VIẾT LIÊN QUAN -->
  <section class="related-posts container">
    <h3>Bài viết liên quan</h3>
    <div class="related-grid">
      <?php foreach ($newsList as $key => $item): ?>
        <?php if ($key !== (int)$id): ?>
          <a href="news_detail.php?id=<?php echo $key; ?>" class="related-item">
            <img src="<?php echo $item['img']; ?>" alt="">
            <p><?php echo htmlspecialchars($item['title']); ?></p>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>© 2025 HomeDecor. Thiết kế & phát triển bởi nhóm Lập Trình Web.</p>
  </footer>
</body>
</html>
