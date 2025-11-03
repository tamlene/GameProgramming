<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'config.php'; // file chứa kết nối database

// ----------------------------
// Thống kê dữ liệu
// ----------------------------
function safeCount($conn, $sql) {
  $res = $conn->query($sql);
  if ($res && $row = $res->fetch_assoc()) {
    return $row['total'] ?? 0;
  }
  return 0;
}

// Lấy số lượng bài viết, bình luận, sản phẩm (thay vì user vì chưa có bảng user)
$news_count = safeCount($conn, "SELECT COUNT(*) AS total FROM news");
$comment_count = safeCount($conn, "SELECT COUNT(*) AS total FROM comments");
$product_count = safeCount($conn, "SELECT COUNT(*) AS total FROM product");

// Tổng lượt xem tất cả bài viết (nếu chưa có cột views, sẽ là 0)
$views_res = $conn->query("SELECT SUM(views) AS total FROM news");
$views_count = ($views_res && $row = $views_res->fetch_assoc()) ? ($row['total'] ?? 0) : 0;
?>

<div class="card">
  <h2 class="h1">Tổng quan</h2>
  <p>Thống kê nhanh</p>
  <div style="display:flex;gap:12px;margin-top:12px;flex-wrap:wrap">
    <div class="card" style="flex:1;min-width:160px">
      <h3><?= $news_count ?></h3>
      <p>Bài viết</p>
    </div>

    <div class="card" style="flex:1;min-width:160px">
      <h3><?= $comment_count ?></h3>
      <p>Bình luận</p>
    </div>

    <div class="card" style="flex:1;min-width:160px">
      <h3><?= $product_count ?></h3>
      <p>Sản phẩm</p>
    </div>

    <div class="card" style="flex:1;min-width:160px">
      <h3><?= number_format($views_count) ?></h3>
      <p>Lượt xem</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
