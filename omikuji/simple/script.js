// ボタンがクリックされた時に呼び出される関数
function buttonClick() {
    const date = new Date();
    const today = date.getDate();
    // localStorage内の日付をもってくる
    const storageLastday = localStorage.getItem('lastDay');
    if (today == storageLastday) {
        // localStorage内の運勢をもってくる
        const storageLastFortune = localStorage.getItem('lastFortune');
        document.querySelector('#omikuji_result').innerHTML = ('今日の運勢は' + storageLastFortune + 'です。また明日占いましょう。');
    } else {
        // 運勢の配列を作る
        const omikuji_result = ["大吉", "中吉", "小吉"];
        // ランダムで運勢を決める
        const random = omikuji_result[Math.floor(Math.random() * omikuji_result.length)];

        // 運勢に応じてコメントを出す
        switch(random) {
        case '大吉':
        document.querySelector('#omikuji_result').innerHTML = ('大吉！　今日はいい日です。');
            break;
        case '中吉':
        document.querySelector('#omikuji_result').innerHTML = ('中吉！　ちょっといいこと起こるかも。');
            break;
        case '小吉':
        document.querySelector('#omikuji_result').innerHTML = ('小吉！　そこそこですね');
            break;
        default:
        document.querySelector('#omikuji_result').innerHTML = ('Error');
        };
        const lastDay = today;
        const lastFortune = random;
        localStorage.setItem('lastDay', lastDay );
        localStorage.setItem('lastFortune', lastFortune );
    }
}