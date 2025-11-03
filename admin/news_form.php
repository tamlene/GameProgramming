<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'config.php'; // kết nối database

// Kiểm tra xem có đang sửa bài viết không
$isEdit = isset($_GET['id']);
$data = ["title"=>"", "content"=>"", "thumb"=>""];

if($isEdit){
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM news WHERE id=$id");
    if($res && $res->num_rows > 0){
        $data = $res->fetch_assoc();
    } else {
        echo "<script>alert('Bài viết không tồn tại!');location.href='news_list.php';</script>";
        exit;
    }
}

// Xử lý khi submit form
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $thumbPath = $data['thumb'];

    // Upload ảnh nếu có
    if(!empty($_FILES['thumb']['name'])){
        $uploadDir = 'uploads/';
        if(!is_dir($uploadDir)) mkdir($uploadDir);
        $fileName = time().'_'.basename($_FILES['thumb']['name']);
        $targetFile = $uploadDir.$fileName;
        if(move_uploaded_file($_FILES['thumb']['tmp_name'], $targetFile)){
            $thumbPath = $targetFile;
        }
    }

    if($isEdit){
        $stmt = $conn->prepare("UPDATE news SET title=?, content=?, thumb=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $content, $thumbPath, $id);
        $stmt->execute();
        echo "<script>alert('Cập nhật bài viết thành công!');location.href='news_list.php';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO news (title, content, thumb) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $thumbPath);
        $stmt->execute();
        echo "<script>alert('Thêm bài viết mới thành công!');location.href='news_list.php';</script>";
    }
    exit;
}
?>

<div class="card">
  <h2><?= $isEdit ? 'Sửa bài viết' : 'Thêm bài viết' ?></h2>
  <form method="post" enctype="multipart/form-data" class="admin-form">
    <div class="form-row">
      <label>Tiêu đề</label>
      <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required>
    </div>

    <div class="form-row">
      <label>Ảnh đại diện</label>
      <input type="file" name="thumb" accept="image/*">
      <?php if(!empty($data['thumb'])): ?>
        <div style="margin-top:8px">
          <img src="<?= htmlspecialchars($data['thumb']) ?>" style="height:80px;border:1px solid #ddd;padding:4px">
        </div>
      <?php endif; ?>
    </div>

    <div class="form-row">
      <label>Nội dung</label>
      <textarea name="content" rows="10" required><?= htmlspecialchars($data['content']) ?></textarea>
    </div>

    <div class="form-row">
      <button class="btn" type="submit"><?= $isEdit ? 'Cập nhật' : 'Lưu' ?></button>
      <a href="news_list.php" class="btn secondary">Hủy</a>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
