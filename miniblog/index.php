//参考
// PHP + MySQLによる簡単なブログサイトの構築
// https://web-svr.com/PHP%E7%B7%A8/60.php
// PHP 画像のアップロード
// https://qiita.com/ryo-futebol/items/11dea44c6b68203228ff
// ChatGPT
// https://chat.openai.com/

<?php
// データベース接続設定
include ('dbconnect.php');
$pdo = new PDO($dsn, $user, $password);

// データベースから投稿を取得
$stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();

// タグ一覧を取得
$stmt = $pdo->query('SELECT DISTINCT tag FROM posts ORDER BY tag ASC');
$tags = $stmt->fetchAll(PDO::FETCH_COLUMN);

// GETパラメータからタグを取得
$tag = isset($_GET['tag']) ? $_GET['tag'] : '';

// HTMLを出力する
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ミニブログ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Kiwi+Maru&family=M+PLUS+Rounded+1c&display=swap');
  body{
    font-family: 'M PLUS Rounded 1c', sans-serif;
  }
  h1 {
    font-family: 'Kiwi Maru', serif;
  }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mt-4 mb-4"><a href="http://mayegg.starfree.jp/">ミニブログ</a></h1>
    <!-- タグ一覧 -->
    <div class="mb-4">
      <h5>タグ</h5>
      <div class="btn-group">
        <a class="btn btn-secondary <?php if (!$tag) echo 'active'; ?>" href="?">すべて</a>
        <?php foreach ($tags as $t): ?>
          <a class="btn btn-secondary <?php if ($tag === $t) echo 'active'; ?>" href="?tag=<?php echo urlencode($t); ?>"><?php echo htmlspecialchars($t, ENT_QUOTES, 'UTF-8'); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- 投稿の一覧 -->
    <?php foreach ($posts as $post): ?>
      <?php if (!$tag || $post['tag'] === $tag): ?>
        <div class="card mb-4">
          <?php if ($post['image_path']): ?>
            <img width="auto" src="<?php echo $post['image_path']; ?>" alt="Card image cap">
          <?php endif; ?>
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
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>

  </div>
</body>
</html>
