<!DOCTYPE html>
<html lang="JP">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>ゆる12星座うらない</title>
<link rel="icon" href="favicon.ico">
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="style.css">
    <!-- ウェブフォント -->
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Zen+Kaku+Gothic+New&display=swap');
    </style>
    <!-- ウェブフォントココマデ -->
<?php 
// 占い部分を読み込み
require("fortune.php");
?>
</head>

<body>
<!-- ローディング画面 -->
<div id="loader">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

<!-- メイン -->
<div id="particles-js"></div>
<div id="wrapper">
    <h1>ゆる12星座うらない</h1>
    <h2>yuru Horoscope</h2>
    <h3>ゆるーいイラストで今日の運勢をお届けします。</h3>

    <?php
        echo "<h3>$today</h3>";
        echo "<div  class='contents'>";
            // 12星座ごとに繰り返す
            for ($i = 0; $i < 12; $i++) {
                // コンテンツ表示エリア
                echo "<div class='horoscope'>";
                // 星座名
                echo "<h1>$h_sign[$i]</h1>";
                // 誕生日
                echo "<h2>$h_birthday[$i]</h2>";
                    // 1位～3位にはマークを表示
                    echo "<div class='images'>";
                        switch ($h_rank[$i]) {
                            case 1:
                                echo "<img src='img/no1.png' class='ranking'>";
                                break;
                            case 2:
                                echo "<img src='img/no2.png' class='ranking'>";
                                break;
                            case 3:
                                echo "<img src='img/no3.png' class='ranking'>";
                                break;
                            default:
                            // 何もしない
                            ;
                        }
                        // 星座のイラストを表示
                        echo "<img src='img/$h_mark[$i].png'>";
                    echo "</div>"; // images

                    // コンテンツ本文
                    echo "<p class='h_content'>$h_content[$i]</p>";
                    
                    echo "<ul>";
                    //運勢の5段階評価
                    echo "<dt>総合運</dt><dd>";
                    // 数値の数だけ★を繰り返し出す
                    for ($n = 0; $n < $h_total[$i]; $n++) {
                        echo "<img src='img/star.png' class='star'>";
                    }
                    echo "<dt>金運</dt><dd>";
                    for ($n = 0; $n < $h_money[$i]; $n++) {
                        echo "<img src='img/star.png' class='star'>";
                    }
                    echo "<dt>仕事運</dt><dd>";
                    for ($n = 0; $n < $h_job[$i]; $n++) {
                        echo "<img src='img/star.png' class='star'>";
                    }
                    echo "<dt>恋愛運</dt><dd>";
                    for ($n = 0; $n < $h_job[$i]; $n++) {
                        echo "<img src='img/star.png' class='star'>";
                    }
                    echo "</dd>";

                    // ラッキーカラー・アイテム
                    echo "<dt>ラッキーアイテム</dt><dd>$h_item[$i]</dd>";
                    echo "<dt>ラッキーカラー</dt><dd>$h_color[$i]</dd>";
                    echo "</ul>";

                echo "</div>"; // horoscope
            }
        echo "<!-- contents --></div>";
    ?>
    <!-- フッターエリア -->
    <footer>
        <p>by <a href="https://mayegg4869.github.io/Portfolio/">mayegg</a></p>
        <p>Illust by <a href="https://www.ac-illust.com/">Illust AC</a></p>
        <p>powerd by <a href="http://jugemkey.jp/api/">JugemKey</a>　【PR】<a href="http://www.tarim.co.jp/">原宿占い館 塔里木</a></p>
    <!-- footer --></footer>
<!-- wrapper --></div>

<!-- JQuery 3.6.0 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- JQueryココマデ -->
<!-- JS -->
<script src="js/particles.min.js"></script>
<script src="js/script.js"></script>
<!-- JSココマデ -->
</body>
</html>
