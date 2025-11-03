<?php
// Cấu hình kết nối Database MySQL
$host = "localhost";      // hoặc 127.0.0.1
$user = "root";           // tên đăng nhập MySQL (mặc định là root)
$pass = "";               // mật khẩu (để trống nếu là XAMPP/MAMP mặc định)
$db   = "homedecor";      // tên cơ sở dữ liệu

// Kết nối MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("❌ Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập charset để tránh lỗi tiếng Việt
$conn->set_charset("utf8mb4");
?>
