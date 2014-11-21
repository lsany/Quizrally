<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>答えまくれ！クイズラリー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/base.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
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

<div class='quiz_text'>
<form role="form" action="q_end.php" method="post">
  <input type="hidden" name="user_id" value='<?php echo $_GET['user_id']?>'/>
<?php
if(isset($_GET['q1'])&&isset($_GET['q2'])&&isset($_GET['q3'])&&isset($_GET['q4'])&&isset($_GET['q5'])&&isset($_GET['q6'])&&isset($_GET['q7'])&&isset($_GET['q8'])){
  ?>
    <p><b>年齢</b><br><span style="color:#2E8B57"><?php echo $_GET['q1']?></span></p><input type="hidden" name="q1" value='<?php echo $_GET['q1']?>' />
    <p><b>性別</b><br><span style="color:#2E8B57"><?php echo $_GET['q2']?></span></p><input type="hidden" name="q2" value='<?php echo $_GET['q2']?>' />
    <p><b>職業</b><br><span style="color:#2E8B57"><?php echo $_GET['q3']?>></span></p><input type="hidden" name="q3" value='<?php echo $_GET['q3']?>' />
    <p><b>端末の種類</b><br><span style="color:#2E8B57"><?php echo $_GET['q4']?></span></p><input type="hidden" name="q4" value='<?php echo $_GET['q4']?>' />
    <p><b>どのようにスタンプをゲットしましたか？</b><br><span style="color:#2E8B57"><?php echo $_GET['q5']?></span></p><input type="hidden" name="q5" value='<?php echo $_GET['q5']?>' />
    <p><b>どなたとスタンプラリーを体験しましたか？</b><br><span style="color:#2E8B57"><?php echo $_GET['q6']?></span></p><input type="hidden" name="q6" value='<?php echo $_GET['q6']?>' />
    <p><b>どうやってアプリの情報を取りましたか？</b><br><span style="color:#2E8B57"><?php echo $_GET['q7']?></span></p><input type="hidden" name="q7" value='<?php echo $_GET['q7']?>' />
    <p><b>スタンプダウロード機能は役に立つと思いますか？（５段階で選択してください。５は満点です。）</b><br><span style="color:#2E8B57"><?php echo $_GET['q8']?></span></p><input type="hidden" name="q8" value='<?php echo $_GET['q8']?>' />

<?php
}
?>
</div>


<?php
echo"
<p style='text-align:center'>
  <button type='submit' class='btn btn-danger'>OK</button>

<a class='btn btn-inverse' href='q.php?user_id={$_GET['user_id']}'>戻る</a>
</p>
</form>
</div>
";
?>
<!--container-->

</body>
</html>
