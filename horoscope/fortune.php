<?php
// 使用API
// https://jugemkey.jp/api/waf/api_free.php
// 参考ドキュメント
// https://www.nob.gr.jp/au/wordpress/1554/
// https://qiita.com/fantm21/items/603cbabf2e78cb08133e

$today = date("Y/m/d");

$url = "http://api.jugemkey.jp/api/horoscope/free/";
$json = file_get_contents($url.$today);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,true);

// jsonを変数に代入
for ($i = 0; $i < 12; $i++) {
    $h_sign[$i] = $arr["horoscope"][$today][$i]["sign"]; // 星座
    $h_content[$i] = $arr["horoscope"][$today][$i]["content"]; // 運勢テキスト
    $h_item[$i] = $arr["horoscope"][$today][$i]["item"]; // ラッキーアイテム
    $h_color[$i] = $arr["horoscope"][$today][$i]["color"]; // ラッキーカラー
    $h_total[$i] = $arr["horoscope"][$today][$i]["total"]; // 総合運
    $h_money[$i] = $arr["horoscope"][$today][$i]["money"]; // 金運
    $h_job[$i] = $arr["horoscope"][$today][$i]["job"]; // 仕事運
    $h_love[$i] = $arr["horoscope"][$today][$i]["love"]; // 恋愛運
    $h_rank[$i] = $arr["horoscope"][$today][$i]["rank"]; // ランキング

    //各星座にマークと誕生日を割り当てる
    switch ($h_sign[$i]) {
        case "牡羊座":
            $h_mark[$i] = "alies";
            $h_birthday[$i] = "3/21～4/19";
            break;
        case "牡牛座":
            $h_mark[$i] = "taurus";
            $h_birthday[$i] = "4/20～5/20";
            break;
        case "双子座":
            $h_mark[$i] = "gemini";
            $h_birthday[$i] = "5/21～6/21";
            break;
        case "蟹座":
            $h_mark[$i] = "cancer";
            $h_birthday[$i] = "6/22～7/22";
            break;
        case "獅子座":
            $h_mark[$i] = "leo";
            $h_birthday[$i] = "7/23～8/22";
            break;
        case "乙女座":
            $h_mark[$i] = "virgo";
            $h_birthday[$i] = "8/23～9/22";
            break;
        case "天秤座":
            $h_mark[$i] = "libra";
            $h_birthday[$i] = "9/23～10/23";
            break;
        case "蠍座":
            $h_mark[$i] = "scorpio";
            $h_birthday[$i] = "10/24～11/22";
            break;
        case "射手座":
            $h_mark[$i] = "sagittarius";
            $h_birthday[$i] = "11/23～12/21";
            break;
        case "山羊座":
            $h_mark[$i] = "capricorn";
            $h_birthday[$i] = "12/22～1/19";
            break;
        case "水瓶座":
            $h_mark[$i] = "aquarius";
            $h_birthday[$i] = "1/20～2/18";
            break;
        case "魚座":
            $h_mark[$i] = "pisces";
            $h_birthday[$i] = "3/19～3/20";
            break;
        default:
            $h_mark[$i] = "Error";
    }
}
?>