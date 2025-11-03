<?php
// sidebar.php
?>
<aside class="admin-sidebar">
  <nav>
    <a href="index.php" class="<?= (basename($_SERVER['PHP_SELF'])=='index.php')?'active':'' ?>">Tổng quan</a>
    <a href="info_edit.php" class="<?= (basename($_SERVER['PHP_SELF'])=='info_edit.php')?'active':'' ?>">Thông tin trang</a>
    <a href="contact_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='contact_list.php')?'active':'' ?>">Liên hệ KH</a>
    <a href="qa_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='qa_list.php')?'active':'' ?>">Q&A</a>
    <a href="product_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='product_list.php')?'active':'' ?>">Sản phẩm</a>
    <a href="order_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='order_list.php')?'active':'' ?>">Đơn hàng</a>
    <a href="news_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='news_list.php')?'active':'' ?>">Tin tức</a>
    <a href="comments_list.php" class="<?= (basename($_SERVER['PHP_SELF'])=='comments_list.php')?'active':'' ?>">Bình luận</a>
  </nav>
</aside>
<div class="admin-main">
