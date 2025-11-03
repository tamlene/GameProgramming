<?php
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'config.php'; // kết nối database

// ------------------------------------------
// XỬ LÝ HÀNH ĐỘNG DUYỆT / XÓA
// ------------------------------------------
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); // ép kiểu tránh lỗi injection

    if ($_GET['action'] == 'approve') {
        $conn->query("UPDATE comment SET status='approved' WHERE id=$id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM comment WHERE id=$id");
    }

    // Quay lại trang chính sau khi xử lý
    header("Location: comments.php");
    exit;
}

// ------------------------------------------
// LẤY DỮ LIỆU TỪ DATABASE
// ------------------------------------------
$sql = "SELECT * FROM comment ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <h2>Bình luận</h2>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Người gửi</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($c = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['user']) ?></td>
            <td><?= htmlspecialchars($c['content']) ?></td>
            <td>
              <span class="status-badge <?= $c['status']=='approved'?'status-done':'status-new' ?>">
                <?= htmlspecialchars($c['status']) ?>
              </span>
            </td>
            <td>
              <?php if($c['status']=='pending'): ?>
                <a href="comments.php?action=approve&id=<?= $c['id'] ?>" 
                   class="btn" 
                   onclick="return confirm('Duyệt bình luận này?')">Duyệt</a>
              <?php endif; ?>
              <a href="comments.php?action=delete&id=<?= $c['id'] ?>" 
                 class="actions delete" 
                 onclick="return confirm('Xóa bình luận này?')">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">Chưa có bình luận nào.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
