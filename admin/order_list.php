<?php
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'config.php'; // kết nối database

// Lấy danh sách đơn hàng từ database
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <h2>Đơn hàng</h2>
  <table class="admin-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Khách</th>
        <th>Tổng</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if($result && $result->num_rows > 0): ?>
        <?php while($o = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $o['id'] ?></td>
          <td><?= htmlspecialchars($o['user_name']) ?></td>
          <td><?= number_format($o['total_price'], 0, ',', '.') ?>₫</td>
          <td>
            <span class="status-badge 
              <?= $o['status']=='hoàn tất' ? 'status-done' : ($o['status']=='chờ xác nhận' ? 'status-new' : ($o['status']=='đang giao' ? 'status-progress' : 'status-cancel')) ?>">
              <?= $o['status'] ?>
            </span>
          </td>
          <td>
            <?php if($o['status'] == 'chờ xác nhận' || $o['status'] == 'đang giao'): ?>
              <a href="orders_update.php?id=<?= $o['id'] ?>&action=complete" class="btn" onclick="return confirm('Đánh dấu hoàn tất?')">Hoàn tất</a>
              <a href="orders_update.php?id=<?= $o['id'] ?>&action=cancel" class="actions delete" onclick="return confirm('Hủy đơn?')">Hủy</a>
            <?php else: ?>
              <span>-</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center">Chưa có đơn hàng nào</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
