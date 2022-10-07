// ------------------------------------------------------------
// ランダムひとことコメント用
        const comment = [
            "ウホウホ",
            "モグモグ",
            "ゴリラは、霊長目ヒト科ゴリラ属（ゴリラぞく、Gorilla）に分類される構成種の総称。<br>引用：Wikipedia",
            "五里霧中",
            "𝒫𝑜𝓌𝑒𝓇"
            ];
        const random = comment[Math.floor(Math.random() * comment.length)];
        document.querySelector('.random').innerHTML = (random);

// ------------------------------------------------------------
    // fancyboxのオプション
        $(document).ready(function() {
            $('[data-fancybox]').fancybox({
                animationEffect: "zoom-in-out",
                loop : true,
                smallBtn : true
            });
        });
// ------------------------------------------------------------
        // タブ切り替え
        jQuery(function($){
            $('.tab').click(function(){
                $('.is-active').removeClass('is-active');
                $(this).addClass('is-active');
                $('.is-show').removeClass('is-show');
                // クリックしたタブからインデックス番号を取得
                const index = $(this).index();
                // クリックしたタブと同じインデックス番号をもつコンテンツを表示
                $('.panel').eq(index).addClass('is-show');
            });
        });
// ------------------------------------------------------------
        // メニュー固定
        let win = $(window),
            header = $('.tab-group'),
            containBottom;
        
        win.on('scroll',function(){     
            containBottom = $('.contain').height();
            if(win.scrollTop() > containBottom){
                header.addClass('fixed');   
            }
            else{
                header.removeClass('fixed');   
            }
        });

        win.trigger('scroll');
// ------------------------------------------------------------
// キラキラエフェクト
// https://web-dev.tech/front-end/javascript/glittering-effect-on-hover/

        // glitterクラスがついた要素を全て取得
        const glitterEls = document.querySelectorAll(".glitter");

        // 取得した要素をArrayに変換
        const glitterElsArr = Array.prototype.slice.call(glitterEls);

        // 取得した要素ひとつひとつに処理を行う
        glitterElsArr.forEach((glitterEl) => {
        let interval;

        // マウスホバー時にキラキラを生成
        glitterEl.addEventListener("mouseenter", () => {
            interval = setInterval(createStar.bind(undefined, glitterEl), 200);
        });

        // マウスを離すと停止
        glitterEl.addEventListener("mouseleave", () => {
            clearInterval(interval);
        });
        });

        // キラキラを生成する関数
        const createStar = (el) => {
        const starEl = document.createElement("span");
        starEl.className = "star";
        starEl.style.left = Math.random() * el.clientWidth + "px";
        starEl.style.top = Math.random() * el.clientHeight + "px";
        el.appendChild(starEl);

        // 一定時間経つとキラキラを消す
        setTimeout(() => {
            starEl.remove();
        }, 1000);
        };

// ------------------------------------------------------------
        // ローディング
        window.onload = function() {
        const spinner = document.getElementById('loading');
        spinner.classList.add('loaded');
        };