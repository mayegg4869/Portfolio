<?php
// データベース接続設定
include ('dbconnect.php');
$pdo = new PDO($dsn, $user, $password);

// 記事の一覧を取得
$stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();

// 削除ボタンが押された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // 削除する記事のIDを取得
    $delete_ids = $_POST['delete_ids'];

    // 削除する記事のIDに一致するレコードを削除
    foreach ($delete_ids as $id) {
        $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $stmt->execute([$id]);
    }

    // index.phpにリダイレクト
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>記事の削除</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4 mb-4">記事の削除</h1>
    <form method="post">
      <div class="form-group">
        <?php foreach ($posts as $post): ?>
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h5>
              <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')); ?></p>
              <p class="card-text"><small class="text-muted">
                <?php if ($post['tag']): ?>
                  <a href="?tag=<?php echo urlencode($post['tag']); ?>"><?php echo htmlspecialchars($post['tag'], ENT_QUOTES, 'UTF-8'); ?></a>
                <?php else: ?>
                  <?php echo '未分類'; ?>
                <?php endif; ?>
              </small></p>
              <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?></small></p>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="delete_ids[]" value="<?php echo $post['id']; ?>">
                <label class="form-check-label">
                  この記事を削除する
                </label>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <button type="submit" class="btn btn-danger" name="delete">削除する</button>
    </form>
  </div>
</body>
</html>
