<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'config.php';

// Lấy danh sách bài viết từ database
$sql = "SELECT id, title, DATE_FORMAT(created_at, '%d/%m/%Y') as date FROM news ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center">
    <h2>Bài viết</h2>
    <div class="controls">
      <a href="news_form.php" class="btn"><i class="fa-solid fa-plus"></i> Thêm</a>
      <input id="searchNews" class="search-input" placeholder="Tìm theo tiêu đề..."/>
    </div>
  </div>

  <table class="admin-table" id="newsTable">
    <thead>
      <tr><th>ID</th><th>Tiêu đề</th><th>Ngày</th><th>Hành động</th></tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= $row['date'] ?></td>
          <td class="actions">
            <a href="news_form.php?id=<?= $row['id'] ?>" class="edit">Sửa</a>
            <a href="news_delete.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Xóa bài viết này?')">Xóa</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="4" style="text-align:center">Chưa có bài viết nào</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
document.getElementById('searchNews').addEventListener('input', function(){
  const q = this.value.toLowerCase();
  document.querySelectorAll('#newsTable tbody tr').forEach(tr=>{
    const title = tr.children[1].textContent.toLowerCase();
    tr.style.display = title.includes(q) ? '' : 'none';
  });
});
</script>

<?php include 'includes/footer.php'; ?>
