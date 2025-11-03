<?php
include 'config.php';

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "✅ Kết nối thành công!<br><br>";
    while ($row = $result->fetch_assoc()) {
        echo $row["id"] . " - " . $row["name"] . " - " . $row["price"] . "<br>";
    }
} else {
    echo "❌ Không có dữ liệu sản phẩm.";
}
?>
