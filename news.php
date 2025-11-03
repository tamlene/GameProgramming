<?php
// Giả lập dữ liệu bài viết (sau này có thể thay bằng dữ liệu từ CSDL)
$newsList = [
  [
    "title" => "Phong cách Scandinavian – Tối giản nhưng tinh tế",
    "desc" => "Khám phá bí quyết trang trí không gian sống theo phong cách Bắc Âu với gam màu trung tính và nội thất gỗ tự nhiên...",
    "img" => "assets/img/news1.jpg",
    "date" => "20/10/2025",
    "link" => "news_detail.php?id=1"
  ],
  [
    "title" => "Xu hướng nội thất 2025 – Tự nhiên & Bền vững",
    "desc" => "Vật liệu thân thiện môi trường đang lên ngôi. Cùng HomeDecor điểm qua những xu hướng hot nhất năm 2025...",
    "img" => "assets/img/news2.jpg",
    "date" => "18/10/2025",
    "link" => "news_detail.php?id=2"
  ],
  [
    "title" => "5 gợi ý giúp phòng khách nhỏ trở nên rộng hơn",
    "desc" => "Sử dụng gương, ánh sáng và màu sắc hợp lý giúp căn phòng của bạn trông thoáng đãng hơn rất nhiều...",
    "img" => "assets/img/news3.jpg",
    "date" => "10/10/2025",
    "link" => "news_detail.php?id=3"
  ]
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tin tức | HomeDecor</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- CSS chung -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- CSS riêng cho trang tin tức -->
  <link rel="stylesheet" href="assets/css/news.css" />
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
        <a href="#" class="active">Tin tức</a>
      </nav>

      <div class="others">
        <input type="text" placeholder="Tìm kiếm..." />
        <i class="fas fa-search"></i>
        <a href="login.php"><i class="fa-regular fa-user"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="news-hero">
    <h1>Tin tức & Bài viết mới nhất</h1>
    <p>Cập nhật xu hướng thiết kế nội thất, mẹo trang trí và nhiều hơn thế nữa!</p>
  </section>

  <!-- KHU VỰC TÌM KIẾM -->
  <section class="search-section">
    <div class="container">
      <input type="text" id="searchInput" placeholder="🔍 Nhập từ khoá để tìm bài viết..." />
    </div>
  </section>

  <!-- DANH SÁCH BÀI VIẾT -->
  <section class="news-list container" id="newsList">
    <?php foreach ($newsList as $news): ?>
      <article class="news-item">
        <a href="<?php echo $news["link"]; ?>" class="news-link">
          <img src="<?php echo $news["img"]; ?>" alt="<?php echo htmlspecialchars($news["title"]); ?>" />
          <div class="content">
            <h2><?php echo htmlspecialchars($news["title"]); ?></h2>
            <p><?php echo htmlspecialchars($news["desc"]); ?></p>
            <span class="date"><i class="fa-regular fa-calendar"></i> <?php echo $news["date"]; ?></span>
          </div>
        </a>
      </article>
    <?php endforeach; ?>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>© 2025 HomeDecor. Thiết kế & phát triển bởi nhóm Lập Trình Web.</p>
  </footer>

  <!-- JS tìm kiếm -->
  <script>
    const searchInput = document.getElementById("searchInput");
    const newsItems = document.querySelectorAll(".news-item");

    searchInput.addEventListener("input", () => {
      const keyword = searchInput.value.toLowerCase().trim();

      newsItems.forEach(item => {
        const title = item.querySelector("h2").textContent.toLowerCase();
        const desc = item.querySelector("p").textContent.toLowerCase();

        if (title.includes(keyword) || desc.includes(keyword)) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    });
  </script>
</body>
</html>
