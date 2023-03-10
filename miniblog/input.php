<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ミニブログ</title>
	<style type="text/css">
	</style>
</head>
<body>
	<h1>ミニブログ｜新規投稿</h1>
	<form action="post.php" method="post" enctype="multipart/form-data">
		<h3><label for="title">タイトル<span style="color: red">*</span></label></h3>
		<input type="text" id="title" name="title" required><br><br>
		<h3><label for="content">本文</label></h3>
		<textarea id="content" name="content"></textarea><br><br>
		<h3><label for="tag">タグ</label></h3>
		<input type="text" id="tag" name="tag"><br><br>
		<h3><label for="image">画像アップロード</label></h3>
		<input type="file" id="image" name="image"><br><br>
		<input type="submit" value="送信">
	</form>
</body>
</html>
