// HTMLのボタンを取る
let button = document.getElementById("button");

// ボタンが押された際に動かしたいプログラミング
button.addEventListener('click', function (ev) {
  // ボタンが押されると動く処理内容ここから
  let textbox = document.getElementById("score");
  let loop_number = textbox.value

    for(let i = 1; i <= loop_number; i++){
        //繰り返す処理
        if((i % 3) === 0 && (i % 5) === 0){
            document.getElementById('innerHTMLtxt').innerHTML += i + '回：' + 'あほになりますだワン！<br>';
        } else if((i % 3) === 0 ) {
            document.getElementById('innerHTMLtxt').innerHTML += i + '回：' + 'あほになります<br>';
        } else if((i % 5) === 0 ) {
            document.getElementById('innerHTMLtxt').innerHTML += i + '回：' + 'ループしたワン！<br>';
        } else {
            document.getElementById('innerHTMLtxt').innerHTML += i + '回：' + 'ループしました<br>';
        }
    }
  // ボタンが押されると動く処理内容ここまで
});
