// -----------------------------------------
// 共通部分
// -----------------------------------------

// 日時取得
let date = new Date();
let nowday = date.getDate();
let nowtime = date.getHours();

// 現在の時刻に応じて背景を変える
let background = document.body;
if ( nowtime > 18 || 6 > nowtime) { // 19時以降もしくは6時以前
    background.style.setProperty('background-image', 'url("img/jinja_03.jpg")', 'important');
} else if( nowtime > 15 && nowtime <= 18) { // 16時～19時まで
    background.style.setProperty('background-image', 'url("img/jinja_02.jpg")', 'important');
} else {
    background.style.setProperty('background-image', 'url("img/jinja_01.jpg")', 'important');
}

// BGMとSEの読み込み
let music = new Audio('music/music.mp3');
let sound = new Audio('music/sound.mp3');
// BGM再生
music.loop = true;
music.muted = true;

// ボタンで切り替えできるようにする
function musicPlay(){
    if(music.muted == true){
        music.play();
        music.muted = false;
        mute.innerHTML = '<span class="material-symbols-outlined">volume_up</span>';
        // console.log(music.muted);
      }else{
        music.muted = true;
        mute.innerHTML = '<span class="material-symbols-outlined">volume_off</span>';
        // console.log(music.muted);
      }
}

// -----------------------------------------
// その日すでに占っていたら
// -----------------------------------------
var storageLastday = localStorage.getItem('lastDay');
if (nowday == storageLastday) {
    var storageLastUnsei = localStorage.getItem('lastUnsei');
    var storageLastUnseiText = localStorage.getItem('lastUnseiText');
    document.querySelector('.comment').innerHTML = ('今日のお主の運勢は' + storageLastUnseiText + 'じゃ！<br>また明日来て欲しいのじゃ！');
    document.querySelector('#omikuji').innerHTML = '<img src="img/' + storageLastUnsei + '.jpg" class="result">';
}

// -----------------------------------------
// おみくじ部分
// -----------------------------------------
// おみくじを引くボタンがクリックされたとき
function buttonClick(){
    // おみくじシェイクエリアを作成
    document.querySelector('#wrap').insertAdjacentHTML('beforeend', '<div id="omikuji_shake"></div>');

    // おみくじ箱の画像を準備
    const omikuji_shake = document.querySelector('#omikuji_shake');
    omikuji_shake.insertAdjacentHTML('beforeend', '<img src="img/omikuji.png" class="shake">');

    // おみくじシェイクエリアを表示
    document.getElementById('omikuji_shake').classList.add('view');

    // BGMがONなら効果音を出す
    if(music.muted == false){
        sound.loop = false;
        sound.play();
    }

    // 2秒後に結果を見るボタンを出す
    window.setTimeout(function(){
        omikuji_shake.insertAdjacentHTML('beforeend', '<a class="btn result" href="javascript:void(0);" onclick="Result();">結果を見る</a>');
    }, 2000);
}

// 結果を見るボタンがクリックされたとき
function Result() {
    // おみくじシェイクエリアを消す
    document.getElementById('omikuji_shake').classList.remove('view');

        // 運勢の配列を定義
        let omikuji_result = ["daikichi", "chuukichi", "shoukichi", "suekichi"];
        // 運勢を決定
        let random = omikuji_result[Math.floor(Math.random() * omikuji_result.length)];
    
        // 運勢に応じた画像を表示
        document.querySelector('#omikuji').innerHTML = '<img src="img/' + random + '.jpg" class="result">';
        // テキストに変換
        let unsei='';
        switch(random) {
            case 'daikichi':
                unsei = "大吉";
                break;
            case 'chuukichi':
                unsei = "中吉";
                break;
            case 'shoukichi':
                unsei = "小吉";
                break;
            case 'suekichi':
                unsei = "末吉";
                break;
            default:
                unsei = "Error";
                console.log('Error');
        }
        // セリフ変更
        document.querySelector('.comment').innerHTML = ('今日のお主の運勢は' + unsei + 'じゃ！');

        // ローカルストレージに、最後に占った日付と運勢を保存
        var lastDay = date.getDate();
        var lastUnsei = random;
        var lastUnseiText = unsei;
        localStorage.setItem('lastDay', lastDay );
        localStorage.setItem('lastUnsei', lastUnsei );
        localStorage.setItem('lastUnseiText', lastUnseiText );

}











