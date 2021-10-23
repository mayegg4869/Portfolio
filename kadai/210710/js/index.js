//-----------------------------------
//    課題A　2021/07/15完成
//-----------------------------------


//------------------
//    問題と答えの定義
//------------------
var question = [
    {
      text: "小説「シャーロック・ホームズ」シリーズの探偵ホームズが嗜んでいた薬物は？",
      select: {
        a: "コカイン",
        b: "ヘロイン",
        c: "ニコチン"
      },
      anser: "a"
    },
    {
      text: "誤差5％以内の精度でアンケート結果を求めるには、どのくらいサンプルを取ればいい？",
      select: {
        a: "400",
        b: "800",
        c: "1200"
      },
      anser: "a"
    },
    {
      text: "「どらえもん」の正しい表記は？",
      anser: "ドラえもん"
    },
    {
      text: "鳥取県と隣接している県は？",
      select: {
        a: "岡山県",
        b: "島根県",
        c: "山口県"
      },
      anser: "ab"
    },
    {
      text: "JavaScriptをより簡潔に記述するために設計されたライブラリは？",
      select: {
        a: "VSCode",
        b: "jQuery",
        c: "SASS"
      },
      anser: "b"
    },
  ];

//------------------
//    問１の出力
//------------------

  document.getElementById('questionNo1').innerHTML = '問題１：' + question[0].text + '<div class="required">※必須</div>';

  document.getElementById('Q1_selectNo1').innerHTML = '<li><label><input type="radio" name="questionNo1" value="a">'+question[0].select.a+'</label></li>'
  document.getElementById('Q1_selectNo2').innerHTML = '<li><label><input type="radio" name="questionNo1" value="b">'+question[0].select.b+'</label></li>'
  document.getElementById('Q1_selectNo3').innerHTML = '<li><label><input type="radio" name="questionNo1" value="c">'+question[0].select.c+'</label></li>'

//------------------
//    問２の出力
//------------------

    document.getElementById('questionNo2').innerHTML = '問題２：' + question[1].text + '<div class="required">※必須</div>';

    document.getElementById('Q2_selectNo1').innerHTML = '<li><label><input type="radio" name="questionNo2" value="a">'+question[1].select.a+'</label></li>'
    document.getElementById('Q2_selectNo2').innerHTML = '<li><label><input type="radio" name="questionNo2" value="b">'+question[1].select.b+'</label></li>'
    document.getElementById('Q2_selectNo3').innerHTML = '<li><label><input type="radio" name="questionNo2" value="c">'+question[1].select.c+'</label></li>'

//------------------
//    問３の出力
//------------------

    document.getElementById('questionNo3').innerHTML = '問題３：' + question[2].text + '<div class="required">※必須</div>';

    document.getElementById('Q3_selectNo1').innerHTML = '<li><label><input type="text" name="questionNo3" value="">※ひらがな・カタカナ</label></li>'
 
//------------------
//    問４の出力
//------------------

    document.getElementById('questionNo4').innerHTML = '問題４：' + question[3].text;

    document.getElementById('Q4_selectNo1').innerHTML = '<li><label><input type="checkbox" name="questionNo4" value="a">'+question[3].select.a+'</label></li>'
    document.getElementById('Q4_selectNo2').innerHTML = '<li><label><input type="checkbox" name="questionNo4" value="b">'+question[3].select.b+'</label></li>'
    document.getElementById('Q4_selectNo3').innerHTML = '<li><label><input type="checkbox" name="questionNo4" value="c">'+question[3].select.c+'</label></li>'

//------------------
//    問５の出力
//------------------

    document.getElementById('questionNo5').innerHTML = '問題５：' + question[4].text + '<div class="required">※必須</div>';

    document.getElementById('Q5_selectNo1').innerHTML = '<li><label><input type="radio" name="questionNo5" value="a">'+question[4].select.a+'</label></li>'
    document.getElementById('Q5_selectNo2').innerHTML = '<li><label><input type="radio" name="questionNo5" value="b">'+question[4].select.b+'</label></li>'
    document.getElementById('Q5_selectNo3').innerHTML = '<li><label><input type="radio" name="questionNo5" value="c">'+question[4].select.c+'</label></li>'

//------------------
//    ボタンを押したときの処理
//------------------

    function submitQuize() {
      document.getElementById('resultArea').innerHTML = "";
      //↑resultAreaの文字を一旦消す

      //回答を変数に格納
      let answers = document.getElementById('quize');
      var anserNum = [
        answers.elements['questionNo1'],
        answers.elements['questionNo2'],
        answers.elements['questionNo3'],
        "",
        answers.elements['questionNo5']
    ];
      //問４だけチェック状態を取得して正解判定用の変数を改めて定義
      //チェックで代入されたa,b,cの組み合わせをanserNum[3]に格納
      let elements = document.getElementsByName("questionNo4");
      for (let i=0; i<elements.length; i++){
        if (elements[i].checked){
          anserNum[3] = anserNum[3] + elements[i].value;
        }
      }

      //空欄チェック・バリデーションここから
      if (anserNum[0].value == "" || anserNum[1].value == "" || anserNum[2].value == ""　|| anserNum[4].value == "") {
        alert('すべての項目を埋めてください');
        return false;
      }
      var reg = new RegExp(/[^ぁ-んァ-ヴ]+/);//バリデーション定義
      if(reg.test(anserNum[2].value)){
        alert('ひらがな・カタカナで入力してください');
        return false;
      }
      //空欄チェック・バリデーションここまで

      //正解判定ここから
      var correct = [];
      for (let i=0,i2=1; i<5; i++,i2++){
        if (anserNum[i].value == question[i].anser && i != 3) {
          document.getElementById('resultArea').innerHTML += "問" + i2 + "：○　";
          correct[i] = 1;
        } else if (i == 3 && anserNum[3] == question[3].anser){ //問3用の処理
          document.getElementById('resultArea').innerHTML += "問" + i2 + "：○　";
         correct[3] = 1;
        }
        else {
          document.getElementById('resultArea').innerHTML += "問" + i2 + "：×　";
          correct[i] = 0;
        }
      }
      //正解判定ここまで

      //合計点算出ここから
      var sum = function(correct) {
        var total = 0;
        for (var i = 0, len = correct.length; i < len; i++) total += correct[i];
        return total;
      };
      var totalScore =  sum(correct);
      document.getElementById('resultArea').innerHTML += "<p>" + totalScore + "/5 正解！</p>";
      //合計点算出ここまで

      //全問正解で紙吹雪
      if (totalScore == 5 ){
        confetti()
        document.getElementById('resultArea').innerHTML += '<p>全問正解です！おめでとう！</p>';
      }

    };

//-----------------------------------
//    課題C　2021/07/27完成
//-----------------------------------

    function quizeBackChange() {
      var elements = document.getElementsByClassName('questionArea');
      for(i=0;i<elements.length;i++){
        elements[i].style.backgroundColor = "#a3a3a3";
      }
    };

    function sliderWidthChange() {
      var elements = document.getElementsByClassName('slider');
      for(i=0;i<elements.length;i++){
        elements[i].style.width = "50%";
      }
    };


















