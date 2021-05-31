//オブジェクト実技
let user = {
    no: 1,
    name: "なまえ",
    sex: "性別",
    age:"年齢",
    adress: "東京都千代田区"
}
//名称
// キー : バリュー;

console.log(user.name);

//配列実技
let arr = [
    "すし", "てんぷら", "すきやき"
];

console.log(arr[1]);
//　配列は0が始点となるため「てんぷら」が出力される


//オブジェクト＆配列のくみあわせ
let users =[{
    no:0,
    sex: "男性",
    age:"20",
    adress: "東京都千代田区"
},{
    no:1,
    sex: "女性",
    age:"23",
    adress: "神奈川県横浜市"
},
]

console.log(users[0]);
console.log(users[0].age);
console.log(users[1].adress);



//①点数によって処理を変更する
/*
//入力した点数を取得
//DOM要素を取得
let ScoreElem = Document.getElementByID('Score');
//DOM要素の中の点数を取得
let Score = ScoreElem.Value();

let Score = 80;
let result = Score ===80;

//理科が80点超える場合　true
if (Score >= 80){
    console.log("合格");
}
console.log("不合格");
*/

// HTMLのボタンを取る
let button = document.getElementById("button");

// ボタンが押された際に動かしたいプログラミング
button.addEventListener('click', function (ev) {
  // ボタンが押されると動く処理内容ここから
  const textbox = document.getElementById("sciense");
  const score = textbox.value

    if (score >= 80) {
        console.log("合格！");
    } else {
        console.log("不合格…");
    }
  // ボタンが押されると動く処理内容ここまで
});

//切り取り線
console.log("-------------------");
// 繰り返し処理　実技
let num = 31;
//3の倍数だけ"あほ"になる
//上級編　5の倍数「犬」になる
for(let i=1; i < num; i++){
    //繰り返す処理
    if((i % 3) === 0 && (i % 5) === 0){
        document.write("あほになりますだワン！");
    } else if((i % 3) === 0 ) {
        document.write("あほになります");
    } else if((i % 5) === 0 ) {
        document.write("ループした回数" + i + "だワン！");
    } else {
        document.write("ループした回数" + i) ;
    }
    document.write("<br>") ;
}
