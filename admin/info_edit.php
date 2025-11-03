<?php
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'config.php'; // kết nối database

// Nếu form gửi lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $site_name = $_POST['site_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $about = $_POST['about'];

  // Upload logo nếu có
  $logoPath = null;
  if (!empty($_FILES['logo']['name'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir);
    $fileName = time() . '_' . basename($_FILES['logo']['name']);
    $targetFile = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile)) {
      $logoPath = $targetFile;
    }
  }

  // Kiểm tra có bản ghi chưa
  $check = $conn->query("SELECT COUNT(*) AS c FROM site_info")->fetch_assoc()['c'];

  if ($check == 0) {
    $stmt = $conn->prepare("INSERT INTO site_info (id, site_name, phone, address, logo, about) VALUES (1, ?, ?, ?, ?, ?)");
  } else {
    if ($logoPath) {
      $stmt = $conn->prepare("UPDATE site_info SET site_name=?, phone=?, address=?, logo=?, about=? WHERE id=1");
    } else {
      $stmt = $conn->prepare("UPDATE site_info SET site_name=?, phone=?, address=?, about=? WHERE id=1");
    }
  }

  // Bind và thực thi
  if ($logoPath) {
    $stmt->bind_param("sssss", $site_name, $phone, $address, $logoPath, $about);
  } else {
    $stmt->bind_param("ssss", $site_name, $phone, $address, $about);
  }
  $stmt->execute();
  echo "<script>alert('Cập nhật thông tin thành công!'); location.href='info.php';</script>";
  exit;
}

// Lấy dữ liệu hiển thị
$res = $conn->query("SELECT * FROM site_info WHERE id=1");
$info = $res && $res->num_rows ? $res->fetch_assoc() : [
  "site_name"=>"",
  "phone"=>"",
  "address"=>"",
  "logo"=>"",
  "about"=>""
];
?>

<div class="card">
  <h2>Thông tin trang</h2>
  <form class="admin-form" method="post" enctype="multipart/form-data">
    <div class="form-row">
      <label>Tên công ty</label>
      <input type="text" name="site_name" value="<?= htmlspecialchars($info['site_name']) ?>">
    </div>

    <div class="form-row">
      <label>Số điện thoại</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($info['phone']) ?>">
    </div>

    <div class="form-row">
      <label>Địa chỉ</label>
      <input type="text" name="address" value="<?= htmlspecialchars($info['address']) ?>">
    </div>

    <div class="form-row">
      <label>Logo</label>
      <input type="file" name="logo">
      <?php if (!empty($info['logo'])): ?>
        <div style="margin-top:8px">
          <img src="<?= htmlspecialchars($info['logo']) ?>" alt="Logo" style="height:60px;border:1px solid #ddd;padding:4px">
        </div>
      <?php endif; ?>
    </div>

    <div class="form-row">
      <label>Giới thiệu</label>
      <textarea name="about" rows="6"><?= htmlspecialchars($info['about']) ?></textarea>
    </div>

    <div class="form-row">
      <button class="btn" type="submit">Lưu</button>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
