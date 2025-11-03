<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'config.php'; // kết nối database

// Lấy danh sách Q&A
$sql = "SELECT * FROM qa ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center">
    <h2>Q&A</h2>
    <a href="qa_form.php" class="btn">Thêm Q&A</a>
  </div>

  <table class="admin-table" id="qaTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Câu hỏi</th>
        <th>Đáp</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if($result && $result->num_rows > 0): ?>
        <?php while($qa = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $qa['id'] ?></td>
            <td><?= htmlspecialchars($qa['question']) ?></td>
            <td><?= htmlspecialchars($qa['answer']) ?></td>
            <td>
              <a href="qa_form.php?id=<?= $qa['id'] ?>" class="edit">Sửa</a>
              <a href="qa_delete.php?id=<?= $qa['id'] ?>" class="delete" onclick="return confirm('Xóa Q&A này?')">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="4" style="text-align:center">Chưa có Q&A nào</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
