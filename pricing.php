<?php
/**
 * Pricing Page - Display service pricing and handle cart operations
 * 
 * This page serves the following purposes:
 * - Display all available services with pricing
 * - Handle search functionality for services
 * - Process add-to-cart requests
 * - Manage cart data persistence
 */

// Define data file paths
$pricingFile = "data/pricing.json";
$cartFile = "data/cart.json";

// Load pricing data from JSON file
$services = json_decode(file_get_contents($pricingFile), true) ?? [];

// Handle search functionality
$keyword = "";
if (isset($_GET["search"]) && trim($_GET["search"]) !== "") {
    $keyword = trim($_GET["search"]);
    // Filter services based on search keyword
    $services = array_filter($services, function ($s) use ($keyword) {
        return stripos($s["name"], $keyword) !== false ||
               stripos($s["desc"], $keyword) !== false;
    });
}

// Process add-to-cart requests
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    $name = $_POST["name"];
    $price = (int)$_POST["price"];

    // Load existing cart data or initialize empty cart
    $cart = file_exists($cartFile)
        ? json_decode(file_get_contents($cartFile), true)
        : [];

    // Check if product already exists in cart
    $found = false;
    foreach ($cart as &$item) {
        if ($item["product"] === $name) {
            $item["quantity"] += 1;
            $found = true;
            break;
        }
    }

    // Add new product to cart if not found
    if (!$found) {
        $cart[] = [
            "product" => $name,
            "price" => $price,
            "quantity" => 1
        ];
    }

    // Save cart data to JSON file
    file_put_contents($cartFile, json_encode($cart, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    // Redirect to prevent form resubmission
    header("Location: pricing.php?added=" . urlencode($name));
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng giá | HomeDecor</title>

  <!-- External stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <!-- Navigation header component -->
  <?php include 'components/header.php'; ?>

  <!-- Main pricing section -->
  <section class="pricing">
    <div class="container">
      <h1>Bảng giá dịch vụ</h1>
      <p>HomeDecor cam kết mang đến mức giá minh bạch và chất lượng vượt mong đợi.</p>

      <!-- Search functionality form -->
      <form method="GET" class="search-bar">
        <input
          type="text"
          name="search"
          placeholder="Tìm kiếm dịch vụ..."
          value="<?= htmlspecialchars($keyword) ?>"
        />
        <button type="submit" class="btn">
          <i class="fa fa-search"></i> Tìm kiếm
        </button>
      </form>

      <?php if (isset($_GET['added'])): ?>
        <div class="alert success">
          ✅ Đã thêm <strong><?= htmlspecialchars($_GET['added']) ?></strong> vào giỏ hàng!
        </div>
      <?php endif; ?>

      <?php if (count($services) === 0): ?>
        <p class="no-result">Không tìm thấy dịch vụ nào phù hợp.</p>
      <?php else: ?>
        <table class="pricing-table">
          <tr>
            <th>Dịch vụ</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th></th>
          </tr>
          <?php foreach ($services as $s): ?>
          <tr>
            <td><?= htmlspecialchars($s["name"]) ?></td>
            <td>
              <?= $s["price"] > 0
                  ? number_format($s["price"], 0, ',', '.') . "đ / m²"
                  : "Liên hệ để báo giá" ?>
            </td>
            <td><?= htmlspecialchars($s["desc"]) ?></td>
            <td>
              <?php if ($s["price"] > 0): ?>
                <form method="POST">
                  <input type="hidden" name="name" value="<?= htmlspecialchars($s["name"]) ?>">
                  <input type="hidden" name="price" value="<?= $s["price"] ?>">
                  <button type="submit" name="add_to_cart" class="btn add-cart">
                    <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                  </button>
                </form>
              <?php else: ?>
                <button class="btn disabled" disabled>Liên hệ</button>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
  </section>

  <!-- Website footer component -->
  <?php include 'components/footer.php'; ?>
</body>
</html>
