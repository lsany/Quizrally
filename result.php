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

    <script>
    var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
    var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags', registeredTags);
    function quiz_list()
    {
      var length;
      if(registeredTags==null)length=0;
      else length=registeredTags.length;
      location.href='quiz_list.php?user_id='+user_id+'&length='+length;
    }
    </script>
    
  </head>


<body>


<?php

echo"
<header>
<h1>
<a href='map.php?user_id={$_GET['user_id']}'><span class='glyphicon glyphicon-chevron-left'></span>MAP</a>
</h1>
</header>
";
?>

<?php
   
    if(isset($_GET['user_id'])){
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
        $count_answered=0;
        $result = mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");
        $row_res= mysql_fetch_array($result);
        for($i=1;$i<=10;$i++){
          $result_user=$row_res[quiz.$i];
          $answer = mysql_query("SELECT * From Quiz where id = $i");
          $row_ans=mysql_fetch_array($answer);
          if($result_user!=0)
          {
            $count_answered++;
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


        if($row_res[age]!=null)
          $score_point+=20;

        mysql_close();
      };
?>

<div class="result">
<div class="comp">
解答終了!!</div>

<p>解答数：<?php echo "$count_answered"; ?>個</p>
<br/>
<p>正解数：<?php echo "$score"; ?>個</p>
<br/>
<p>総得点：<?php echo "$score_point";?>点</p>

<?php
if($row_res[age]==null)
echo "
<font size=2 color=yellow>下のアンケートを記入すると、ボーナスポイントがもらえますよ！</font>
";
?>
<div align="center">
<img src="img/komakero.png" style="width:30%;height:30%;">
</div>
</div>

<div class="container" style="margin-bottom:90px; margin-top:40px;">
<br/>
<br/>
<?php
echo "
<a id='start_btn' class='btn btn-danger btn-block btn-lg radius2' href='spot.php?user_id={$_GET['user_id']}' style='margin-bottom:30px;'>景品交換所</a>
<a id='manual_btn' class='btn btn-danger btn-block btn-lg radius2' onclick='quiz_list();' style='margin-bottom:30px;'>クイズ一覧</a>
";


if($row_res[age]==null)
echo "
<a id='start_btn' class='btn btn-danger btn-block btn-lg radius2' href='q.php?user_id={$_GET['user_id']}' style='margin-bottom:30px;'>アンケート</a>
";
?>

</div>

<div class="link_area3">
<div class="kokosil-logo">
<a href="kokosil.html"><img src="img/kokosil-logo.png" class="image100"></a>
</div>
</div>


<footer>
  <a href="gcl.html" >
提供：東京大学坂村・越塚研究室<br>
東京大学リーディングプログラムGCL
</a>
</footer>
</body>
</html>
