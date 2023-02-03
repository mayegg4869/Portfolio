
/*
参考
https://web-dev.tech/front-end/javascript/snow-falling-effect/
https://suzuri.jp/search?q=%E3%82%B4%E3%83%AA%E3%83%A9
*/



function gorillaSwitch() {
            document.getElementById('container').classList.add('gorillaFall');
            
            // コンテナを指定
            const container = document.querySelector('.gorillaFall');
        
            // 雪を生成する関数
            const creategorilla = () => {
            const gorillaEl = document.createElement('span');
            gorillaEl.className = 'gorilla';
            const minSize = 25;
            const maxSize = 80;
            const size = Math.random() * (maxSize - minSize) + minSize;
            gorillaEl.style.fontSize = `${size}px`;
            gorillaEl.style.left = Math.random() * 100 + '%';
            container.appendChild(gorillaEl);
        
            // 一定時間が経てば雪を消す
            setTimeout(() => {
                gorillaEl.remove();
            }, 10000);
            }
        
            // 雪を生成する間隔をミリ秒で指定
            setInterval(creategorilla, 500);
}
