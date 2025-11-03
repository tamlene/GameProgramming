<?php
require_once '../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$isEdit = isset($_GET['id']);
$data = ['question'=>'','answer'=>''];

if($isEdit){
    $stmt = $pdo->prepare("SELECT * FROM qa WHERE id=?");
    $stmt->execute([(int)$_GET['id']]);
    $data = $stmt->fetch();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if($isEdit){
        $stmt = $pdo->prepare("UPDATE qa SET question=?, answer=? WHERE id=?");
        $stmt->execute([$question, $answer, (int)$_GET['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO qa (question, answer) VALUES (?, ?)");
        $stmt->execute([$question, $answer]);
    }

    header("Location: qa_list.php");
    exit;
}
?>

<div class="card">
  <h2><?= $isEdit? 'Sửa Q&A':'Thêm Q&A' ?></h2>
  <form method="post" class="admin-form">
    <div class="form-row">
      <label>Câu hỏi</label>
      <input type="text" name="question" value="<?= htmlspecialchars($data['question']) ?>" required>
    </div>

    <div class="form-row">
      <label>Đáp</label>
      <textarea name="answer" rows="6"><?= htmlspecialchars($data['answer']) ?></textarea>
    </div>

    <div class="form-row">
      <button class="btn" type="submit">Lưu</button>
      <a class="btn secondary" href="qa_list.php">Hủy</a>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
