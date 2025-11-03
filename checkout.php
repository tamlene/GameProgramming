<?php
/**
 * Checkout Page - Handle order processing and payment
 * 
 * This page handles:
 * - Loading cart data and validating it's not empty
 * - Calculating total order amount
 * - Processing order submission
 * - Saving order data to JSON file
 * - Clearing cart after successful order
 * - Redirecting to success page
 */

// Define data file paths
$cartFile = "data/cart.json";
$orderFile = "data/orders.json";

// Load cart data
$cartData = json_decode(file_get_contents($cartFile), true) ?? [];

// Redirect to cart if empty
if (empty($cartData)) {
    header("Location: cart.php");
    exit;
}

// Calculate total order amount
$total = 0;
foreach ($cartData as $item) {
    $total += $item["price"] * $item["quantity"];
}

// Process order submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Create order object with customer details
    $order = [
        "name" => trim($_POST["name"]),
        "phone" => trim($_POST["phone"]),
        "address" => trim($_POST["address"]),
        "note" => trim($_POST["note"]),
        "total" => $total,
        "items" => $cartData,
        "date" => date("Y-m-d H:i:s")
    ];

    // Load existing orders or initialize empty array
    $orders = file_exists($orderFile)
        ? json_decode(file_get_contents($orderFile), true)
        : [];
    
    // Add new order to orders list
    $orders[] = $order;
    file_put_contents($orderFile, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Clear cart after successful order
    file_put_contents($cartFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirect to success page
    header("Location: checkout_success.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán | HomeDecor</title>
  
  <!-- External stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Navigation header component -->
<?php include 'components/header.php'; ?>

<!-- Order checkout form section -->
<section class="checkout container">
  <h1>🧾 Thanh toán đơn hàng</h1>

  <h3>Thông tin giỏ hàng</h3>
  <table>
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cartData as $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['product']) ?></td>
        <td><?= number_format($item['price'], 0, ',', '.') ?>₫</td>
        <td><?= $item['quantity'] ?></td>
        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>₫</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Tổng cộng: <?= number_format($total, 0, ',', '.') ?>₫</h3>

  <hr>

  <h3>Thông tin người nhận</h3>
  <form method="POST" class="checkout-form">
    <label>Họ và tên:</label>
    <input type="text" name="name" required>

    <label>Số điện thoại:</label>
    <input type="text" name="phone" required>

    <label>Địa chỉ giao hàng:</label>
    <textarea name="address" rows="3" required></textarea>

    <label>Ghi chú (tuỳ chọn):</label>
    <textarea name="note" rows="2"></textarea>

    <button type="submit" class="btn">Xác nhận thanh toán</button>
  </form>
</section>

<!-- Website footer component -->
<?php include 'components/footer.php'; ?>

</body>
</html>
