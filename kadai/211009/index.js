for(let i = 1; i <= 100; i++){
    //繰り返す処理
    if((i % 3) === 0 && (i % 5) === 0){
        console.log(i + '回目：' + '私はアホ犬なのでしょうかワン？');
    } else if((i % 3) === 0 ) {
        console.log(i +'回目：' + 'あほ');
    } else if((i % 5) === 0 ) {
        console.log(i +'回目：' + 'いぬ');
    } else {
        console.log(i +'回目：' + 'ループしました');
    }
}