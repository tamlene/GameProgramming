<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'config.php'; // kết nối database

// Lấy danh sách sản phẩm
$sql = "SELECT * FROM product ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center">
    <h2>Sản phẩm</h2>
    <div>
      <a href="product_form.php" class="btn">Thêm sản phẩm</a>
      <input id="searchProd" class="search-input" placeholder="Tìm...">
    </div>
  </div>

  <table class="admin-table" id="prodTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Kho</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if($result && $result->num_rows > 0): ?>
        <?php while($p = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td>
            <?php if(!empty($p['image'])): ?>
              <img src="<?= htmlspecialchars($p['image']) ?>" style="height:50px;border:1px solid #ddd;padding:2px">
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><?= number_format($p['price'],0,',','.') ?>₫</td>
          <td><?= $p['stock'] ?></td>
          <td>
            <a href="product_form.php?id=<?= $p['id'] ?>" class="edit">Sửa</a>
            <a href="product_delete.php?id=<?= $p['id'] ?>" class="delete" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="6" style="text-align:center">Chưa có sản phẩm nào</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
document.getElementById('searchProd').addEventListener('input', function(){
  const q=this.value.toLowerCase();
  document.querySelectorAll('#prodTable tbody tr').forEach(tr=>{
    tr.style.display = tr.children[2].textContent.toLowerCase().includes(q) ? '' : 'none';
  });
});
</script>

<?php include 'includes/footer.php'; ?>
