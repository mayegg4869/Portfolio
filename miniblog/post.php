<?php
// データベースに接続する
include ('dbconnect.php');
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
}

// タイトルが入力されているかチェックする
if (empty($_POST['title'])) {
	exit('タイトルは必須です。');
}

// タグが未入力の場合は「未分類」を設定する
$tag = empty($_POST['tag']) ? '未分類' : $_POST['tag'];

// 画像がアップロードされた場合は、imagesフォルダに保存する
$image_path = '';
if (!empty($_FILES['image']['name'])) {
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  $image_name = date('YmdHis') . '.' . $ext;
  $image_path = 'images/' . $image_name;
  move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}


// データベースに投稿を登録する
$stmt = $pdo->prepare('INSERT INTO posts(title, content, tag, image_path) VALUES(:title, :content, :tag, :image_path)');
$stmt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
$stmt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
$stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
$stmt->execute();

// 完了メッセージを表示する
echo '<p>投稿が完了しました。</p>';
echo '<a href="index.php">トップへ</a>';