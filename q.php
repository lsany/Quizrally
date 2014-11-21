<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>答えまくれクイズラリー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/base.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico">

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/kokosil-client.js"></script>
    <script src="js/stamprally-api.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script>
    var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
    function submitQuestionNaire(){
      var q1 = $("select[id='q1']").val();
      var q2 = $("select[id='q2']").val();
      var q3 = $("select[id='q3']").val();
      var q4 = $("select[id='q4']").val();
      var q5 = $("select[id='q5']").val();
      var q6 = $("select[id='q6']").val();
      var q7 = $("select[id='q7']").val();
      var q8 = $("select[id='q8']").val();
      //alert(q1+q2+q3+q4+q5+q6+q7);
      
      //alert(user_id);
      //user_id="0001";

      if(q1=="選択してください"||q2=="選択してください"||q3=="選択してください"||q4=="選択してください"||q5=="選択してください"||q6=="選択してください"||q7=="選択してください"||q8=="選択してください"){
          $("#err").html("<p style='color:red'>全ての質問に回答をお願いします。</p>");
          return false;
      }else{
         q_form.action = "q_check.php?user_id="+user_id+"&q1="+q1+"&q2="+q2+"&q3="+q3+"&q4="+q4+"&q5="+q5+"&q6="+q6+"&q7="+q7+"&q8="+q8;
        return true;
      }       
    }
    </script>
  </head>


<body>



<?php
echo"
<div class='header_map'>
<h1>
<a href='map.php?user_id={$_GET['user_id']}'><span class='glyphicon glyphicon-chevron-left'></span>MAP</a>
</h1>
</div>
";
?>
    


<div class="container" style="margin-bottom:70px;">

<div class="row">
<div class="col-xs-12">

<form id="q_form" name="q_form" role="form" onsubmit="return submitQuestionNaire()" method="post">
  <div class="form-group">
    <label for="">年齢</label>
    <select class="form-control" id="q1">
    <option selected="selected">選択してください</option>
      <option>10歳未満</option>
      <option>10代</option>
      <option>20代</option>
      <option>30代</option>
      <option>40代</option>
      <option>50代</option>
      <option>60代以上</option>
  </select>
  </div>
  
   <div class="form-group">
    <label for="">性別</label>
    <select class="form-control" id="q2">
      <option selected="selected">選択してください</option>
      <option>男性</option>
      <option>女性</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="">職業</label>
    <select class="form-control" id="q3">
      <option selected="selected">選択してください</option>
      <option>小中高生</option>
      <option>大学生</option>
      <option>社会人</option>
      <option>専業主婦 </option>
      <option>その他</option>
    </select>
  </div>

  <div class="form-group">
    <label for="">端末の種類</label>
    <select class="form-control" id="q4">
      <option selected="selected">選択してください</option>
      <option>Android機種</option>
      <option>ios機種(iphone、ipod等)</option>
    </select>
  </div>

   <div class="form-group">
    <label for="">どのようにスタンプをゲットしましたか？</label>
    <select class="form-control" id="q5">
      <option selected="selected">選択してください</option>
      <option>QRコードからの取得</option>
      <option>パネルをタッチ</option>
      <option>Bluetoothからゲット</option>
    </select>
  </div>

<div class="form-group">
    <label for="">どなたとスタンプラリーを体験しましたか？</label>
    <select class="form-control" id="q6">
      <option selected="selected">選択してください</option>
      <option>一人で</option>
      <option>友達と一緒に</option>
      <option>家族と一緒に</option>
      <option>その他</option>
    </select>
</div>

<div class="form-group">
    <label for="">どうやってアプリの情報を取りましたか？</label>
    <select class="form-control" id="q7">
      <option selected="selected">選択してください</option>
      <option>ラリー冊子</option>
      <option>現場のパネル</option>
      <option>友達の紹介</option>
      <option>HPを見て</option>
      <option>その他</option>
    </select>
</div>
     
  <div class="form-group">
    <label for="">今回のクイズは難しいと思いますか？（５段階で選択してください。数字が大きい方が難しいです。）</label>
    <select class="form-control" id="q8">
      <option selected="selected">選択してください</option>
      <option>５</option>
      <option>４</option>
      <option>３</option>
      <option>２</option>
      <option>１</option>
    </select>
</div>

  <p style="text-align:center">
 <a><button type="submit" class="btn btn-danger">確認</button></a>
 <a><button type="reset" class="btn btn-inverse">リセット</button></a>
  </p>
</form>
</div>
</div>
</div>


</body>
</html>
