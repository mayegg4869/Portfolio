console.log('Hello World!');
console.error('エラーが発生しました。');

//HTMLのIDを取得する
let strElem = document.getElementById('str');
strElem = "代入したよ";
console.log(strElem);

let str = 'Hello World!';

//HTMLに表示する
strElem.innerHTML = str;

//変数　→　箱のようなもの
//なぜ箱？　→　何でも入る（文字、数字、変数、関数）;
// let = 入れるもの;
// const var

//四則演算
//　足し算 +
//　引き算 -
//　掛け算 *
//　割り算 /

let FamillyName ='鈴木';
let LastName = '一郎';

console.log(FamillyName + LastName);
console.log(1 + 1);

console.log('1' + 1);
console.log('"1"' + 1);

let number = 2;
if (number == 1){
    console.log ("数字は1です。")
} else if (number != 1){
    console.log ("数字は1以外です。")
}

//型
//文字型　
//数字型

//コーヒーをなにかに入れる場合、
//入れ物：マグカップ
//※入れ物：ダンボールにコーヒーは入らない。

//コーヒに入れるのはマグカップ＝＝＞正しい型
//ダンボールに入れるのは＝＝＞間違った型

//型の使い分け
//文字型　最初の文字にのみ処理を入れる
//数字型　計算

var HeyYo = ["HEY!", "YO!", "YEAH!", "CHECK IT OUT!"];
console.log(HeyYo[Math.floor(Math.random() * HeyYo.length)]);