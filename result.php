<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>答えまくれクイズラリー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/kokosil-client.js"></script>
    <script src="js/stamprally-api.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script>
    function quiz_list()
    {
      var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
      var length;
      var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags', registeredTags);
      if(registeredTags==null)length=0;
      else length=registeredTags.length;
      location.href='quiz_list.php?user_id='+user_id+'&length='+length;
    }
    </script>
    
  </head>


<body>

<header>
<h1><a href="map.html"><span class="glyphicon glyphicon-chevron-left"></span>
MAP</a></h1>

</header>

<?php
   
    if(isset($_GET['user_id'])){
        //$conn=mysql_connect("localhost","root","");
        $conn=mysql_connect("localhost","root","komaba2014");
        mysql_set_charset('utf8');
        mysql_select_db("Komaba_Festival");
        if (!$conn){
             die('Could not connect: ' . mysql_error());
        }

        $flag_finish_query = "UPDATE Users SET flag_finish=1 WHERE user_id='{$_GET['user_id']}'";
        mysql_query($flag_finish_query);

        $score=0;
        $score_point=0;
        $result = mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");
        $row_res= mysql_fetch_array($result);
        for($i=1;$i<=10;$i++){
          $result_user=$row_res[quiz.$i];
          $answer = mysql_query("SELECT * From Quiz where id = $i");
          $row_ans=mysql_fetch_array($answer);
          if($result_user!=0)
          {
            if($result_user==$row_ans[answer])
            {
              if($i<=4) $score_point+=10;
              elseif($i<=7) $score_point+=20;
              elseif($i<=9) $score_point+=30;
              else $score_point+=40;
              $score++;
            }
            else 
            {
              if($i<=4) $score_point+=0;
              elseif($i<=7) $score_point+=10;
              elseif($i<=9) $score_point+=10;
              else $score_point+=20;
            }
          }
        }
        mysql_close();
      };
?>

<div  style="background-color:#551A8B; text-align:center;
  background-position:center center;
  width:70%;
  min-height:40%;
  margin: 0 auto;
  color:#ffffff;" > 
<!--<img src="img/result.png" style="width:60%;height:60%;">-->
<br/>
<font size='3' color='red'>コンプリート!!</font>

<br/>
正解数：<?php echo "$score"; ?>個
<br/>
総得点：<?php echo "$score_point";?>点
<div align="center">

<img src="img/komakero.png" style="width:30%;height:30%;">

</div>

</div>

<div class="container" style="margin-bottom:90px; margin-top:40px;">
<br/>
<br/>
<?php
echo "
<a id=\"start_btn\" class=\"btn btn-danger btn-block btn-lg radius2\" href=\"spot.php?user_id={$_GET['user_id']}\" style=\"margin-bottom:30px;\">景品交換所</a>
<a id=\"manual_btn\" class=\"btn btn-danger btn-block btn-lg radius2\" onclick=\"quiz_list();\" style=\"margin-bottom:30px;\">クイズ一覧</a>
"
?>


<!--<a id="reset_btn" class="btn btn-danger btn-block btn-lg radius2" href="javascript:Main.reset();" style="margin-bottom:30px;">Reset</a>
<img src="img/intro.png" style="width:95%;height:100%;">

<p style="color:#333399;text-shadow:3px 3px 3px rgba(0, 0, 0, 0.2)">今年の五月祭「東大制覇ラリー〜館コレ〜」のご利用、誠にありがとうございました。
スタンプ詳細ページでめいちゃんの画像をクッリクすると、スタンプのダウロードができます〜
</p>!-->


<!--<a class="btn btn-danger btn-block btn-lg radius2" href="kokosil.html" style="margin-bottom:30px;">
ココシルロゴ
</a>-->

</div>
<!--container-->

<div class="link_area3">
<div class="kokosil-logo">
<a href="kokosil.html"><img src="img/kokosil-logo.png" class="image100"></a>
</div>
</div>

<a href="gcl.html" >
<footer style="font-size:12px; line-height:1.4;">
提供：東京大学坂村・越塚研究室<br>
東京大学リーディングプログラムGCL
</footer>
</a>

</body>
</html>
