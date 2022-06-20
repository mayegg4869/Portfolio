        // ランダムひとことコメント用
        let comment = [
            "ウホウホ",
            "モグモグ",
            "ゴリラは、霊長目ヒト科ゴリラ属（ゴリラぞく、Gorilla）に分類される構成種の総称。<br>引用：Wikipedia"
            ];
        let random = comment[Math.floor(Math.random() * comment.length)];
        document.querySelector('.random').innerHTML = (random);
    
    // fancyboxのオプション
        $(document).ready(function() {
            $('[data-fancybox]').fancybox({
                animationEffect: "zoom-in-out",
                loop : true,
                smallBtn : true
            });
        });

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

        // メニュー固定
        var _window = $(window),
            _header = $('.tab-group'),
            heroBottom;
        
        _window.on('scroll',function(){     
            heroBottom = $('.contain').height();
            if(_window.scrollTop() > heroBottom){
                _header.addClass('fixed');   
            }
            else{
                _header.removeClass('fixed');   
            }
        });
        
        _window.trigger('scroll');

        // ローディング
        window.onload = function() {
        const spinner = document.getElementById('loading');
        spinner.classList.add('loaded');
        };