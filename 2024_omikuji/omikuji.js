// -----------------------------------------
// 共通部分
// -----------------------------------------

// 画像のpreload
const images = [
    'img/chara.png',
    'img/omikuji.png',
    'img/daikichi.jpg',
    'img/chuukichi.jpg',
    'img/shoukichi.jpg',
    'img/suekichi.jpg',
    'img/kyou.jpg',
    'img/daikyou.jpg'
];

// 日時取得
const date = new Date();
const nowyear = date.getFullYear();

// BGMとSEの読み込み
const music = new Audio('music/music.mp3');
const sound = new Audio('music/sound.mp3');
// BGM再生
music.loop = true;
music.muted = true;

// ボタンで切り替えできるようにする
function musicPlay(){
    if(music.muted){
        music.play();
        music.muted = false;
        mute.innerHTML = '<span class="material-symbols-rounded">volume_up</span>';
        // console.log(music.muted);
      }else{
        music.muted = true;
        mute.innerHTML = '<span class="material-symbols-rounded">volume_off</span>';
        // console.log(music.muted);
      }
}

//すべて読み込んだときの処理
window.onload = function(){
    let i;
    // 画像プリロード
    for (i = 0; i < images.length; i++){
        const img = document.createElement('img');
        img.src = images[i];
    }
    // ローディング終了
    const loader = document.getElementById('loader');
    loader.classList.add('loaded');
}
// -----------------------------------------
// その年すでに占っていたら
// -----------------------------------------
const storageLastyear = localStorage.getItem('lastYear');
if (nowyear == storageLastyear) {
    const storageLastFortune = localStorage.getItem('lastFortune');
    const storageLastFortuneText = localStorage.getItem('lastFortuneText');
    document.querySelector('.comment').innerHTML = ('今年のあなたの運勢は' + storageLastFortuneText + '！');
    document.querySelector('#omikuji').innerHTML = '<img src="img/' + storageLastFortune + '.jpg" class="result">';
    
} else {
    // 日付が変わっていたらlocalstorageをクリア
    localStorage.clear()
}

// -----------------------------------------
// おみくじ部分
// -----------------------------------------
// おみくじを引くボタンがクリックされたとき
function buttonClick(){

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
    const omikuji_result = ["daikichi", "chuukichi", "shoukichi", "suekichi", "kyou", "daikyou"];
    // 運勢を決定
    let random = omikuji_result[Math.floor(Math.random() * omikuji_result.length)];

    // 運勢に応じた画像を表示
    document.querySelector('#omikuji').innerHTML = '<img src="img/' + random + '.jpg" class="result">';

    // ひとことコメント
    const commentList = [
        "出だしから最高潮！",
        "普通が一番！",
        "大丈夫、どうせランダムだから！"
    ];

    // テキストに変換
    let fortune='';
    switch(random) {
        case 'daikichi':
            fortune = "大吉";
            comment = commentList[0];
            break;
        case 'chuukichi':
            fortune = "中吉";
            comment = commentList[1];
            break;
        case 'shoukichi':
            fortune = "小吉";
            comment = commentList[1];
            break;
        case 'suekichi':
            fortune = "末吉";
            comment = commentList[1];
            break;
        case 'kyou':
            fortune = "凶";
            comment = commentList[2];
            break;
        case 'daikyou':
            fortune = "大凶";
            comment = commentList[2];
            break;
        default:
            fortune = "Error";
            console.log('Error');
    }
    // セリフ変更
    document.querySelector('.comment').innerHTML = ('今年のあなたの運勢は' + fortune + '！<br>' + comment);

    // ローカルストレージに、最後に占った日付と運勢を保存
    const lastYear = nowyear;
    const lastFortune = random;
    const lastFortuneText = fortune;
    localStorage.setItem('lastYear', lastYear );
    localStorage.setItem('lastFortune', lastFortune );
    localStorage.setItem('lastFortuneText', lastFortuneText );
}
// おわり