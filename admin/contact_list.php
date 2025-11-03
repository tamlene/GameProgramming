<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'config.php'; // Kết nối database

// Xử lý hành động (đọc / xóa)
if (isset($_GET['action']) && isset($_GET['id'])) {
  $id = (int)$_GET['id'];

  if ($_GET['action'] === 'read') {
    $conn->query("UPDATE contact SET status='đã đọc' WHERE id=$id");
  } elseif ($_GET['action'] === 'delete') {
    $conn->query("DELETE FROM contact WHERE id=$id");
  }

  header("Location: contacts.php");
  exit;
}

// Lấy dữ liệu liên hệ
$sql = "SELECT * FROM contact ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <h2>Liên hệ khách hàng</h2>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Điện thoại</th>
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
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['phone']) ?></td>
            <td><?= htmlspecialchars($c['message']) ?></td>
            <td>
              <span class="status-badge <?= $c['status']=='chưa đọc'?'status-new':'status-done' ?>">
                <?= htmlspecialchars($c['status']) ?>
              </span>
            </td>
            <td>
              <?php if($c['status']=='chưa đọc'): ?>
                <a href="?action=read&id=<?= $c['id'] ?>" class="btn">Đã đọc</a>
              <?php endif; ?>
              <a href="?action=delete&id=<?= $c['id'] ?>" class="actions delete" onclick="return confirm('Xóa liên hệ này?')">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7" style="text-align:center">Chưa có liên hệ nào.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
