<?php
/**
 * Shopping Cart Page - Display cart items and calculate totals
 * 
 * This page handles:
 * - Loading cart data from JSON file
 * - Calculating total price for all items
 * - Displaying cart contents to user
 */

// Load cart data from JSON file
$cartData = json_decode(file_get_contents('data/cart.json'), true);

// Calculate total price for all items in cart
$total = 0;
foreach ($cartData as $item) {
  $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng | HomeDecor</title>
  
  <!-- External stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <!-- Navigation header component -->
  <?php include 'components/header.php'; ?>

  <!-- Shopping cart display section -->
  <section class="cart">
    <div class="container about-content">
      <div class="text">
        <h1>Giỏ hàng của bạn</h1>
        <p>Kiểm tra sản phẩm trước khi thanh toán:</p>

        <?php if (empty($cartData)): ?>
          <p>🛒 Giỏ hàng trống.</p>
        <?php else: ?>
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

        <a href="checkout.php" class="btn">Tiến hành thanh toán</a>
        <?php endif; ?>
      </div>

      <div class="image">
        <img src="assets/img/cart.jpg" alt="Cart HomeDecor">
      </div>
    </div>
  </section>

  <!-- Website footer component -->
  <?php include 'components/footer.php'; ?>
</body>
</html>
