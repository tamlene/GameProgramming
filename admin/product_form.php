<?php
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'config.php'; // kết nối database

$isEdit = isset($_GET['id']);
$data = ["name"=>"","price"=>"","stock"=>0,"image"=>"","category"=>""];

// Nếu là sửa -> lấy dữ liệu từ database
if($isEdit){
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM product WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res && $res->num_rows>0){
        $data = $res->fetch_assoc();
    } else {
        echo "<script>alert('Sản phẩm không tồn tại!');location.href='product_list.php';</script>";
        exit;
    }
}

// Xử lý submit form
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'] ?? '';

    $imagePath = $data['image'];

    // Upload ảnh nếu có
    if(!empty($_FILES['image']['name'])){
        $uploadDir = 'uploads/';
        if(!is_dir($uploadDir)) mkdir($uploadDir);
        $fileName = time().'_'.basename($_FILES['image']['name']);
        $targetFile = $uploadDir.$fileName;
        if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFile)){
            // Xóa ảnh cũ khi sửa
            if($isEdit && !empty($data['image']) && file_exists($data['image'])){
                unlink($data['image']);
            }
            $imagePath = $targetFile;
        }
    }

    if($isEdit){
        $stmt = $conn->prepare("UPDATE product SET name=?, price=?, category=?, image=? WHERE id=?");
        $stmt->bind_param("sdssi",$name,$price,$category,$imagePath,$id);
        $stmt->execute();
        echo "<script>alert('Cập nhật sản phẩm thành công!');location.href='product_list.php';</script>";
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO product (name, price, category, image) VALUES (?,?,?,?)");
        $stmt->bind_param("sdss",$name,$price,$category,$imagePath);
        $stmt->execute();
        echo "<script>alert('Thêm sản phẩm mới thành công!');location.href='product_list.php';</script>";
        exit;
    }
}
?>

<div class="card">
  <h2><?= $isEdit? 'Sửa sản phẩm':'Thêm sản phẩm' ?></h2>
  <form class="admin-form" method="post" enctype="multipart/form-data">
    <div class="form-row"><label>Tên sản phẩm</label><input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required></div>
    <div class="form-row"><label>Giá</label><input type="number" name="price" value="<?= htmlspecialchars($data['price']) ?>" required></div>
    <div class="form-row"><label>Kho</label><input type="number" name="stock" value="<?= htmlspecialchars($data['stock']) ?>" required></div>
    <div class="form-row"><label>Danh mục</label><input type="text" name="category" value="<?= htmlspecialchars($data['category']) ?>"></div>
    <div class="form-row"><label>Ảnh</label><input type="file" name="image">
        <?php if(!empty($data['image'])): ?>
        <div style="margin-top:8px"><img src="<?= htmlspecialchars($data['image']) ?>" style="height:80px;border:1px solid #ddd;padding:4px"></div>
        <?php endif; ?>
    </div>
    <div class="form-row">
        <button class="btn" type="submit"><?= $isEdit?'Cập nhật':'Lưu' ?></button>
        <a class="btn secondary" href="product_list.php">Hủy</a>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
