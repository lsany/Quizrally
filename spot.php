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

  </head>

<body>
    <?php
    /*echo "
    <div class='header_map'>
    <h1><a href='result.php?user_id={$_GET['user_id']}'><span class='glyphicon glyphicon-chevron-left'>
    </span>戻る</a></h1>
    </div>
    <div class='stamp_area_head count' style='margin-bottom:0px;'>
      景品交換所
    </div>
    "*/
    echo "
    <header>
        <h1>
        <table border='0px' width='100%'> 
        <tr>
        <td width='25%'>
        <a href='map.php?user_id={$_GET['user_id']}'><span class='glyphicon glyphicon-chevron-left'></span>MAP</a>
        </td>
        <td align='center'>
        景品交換所
        </td>
        <td width='25%'>
        </td>
        </tr>
        </table>
        </h1>
        </header>
    ";
?>



<div class='quiz_text'>
  <p align = 'center'>11号館1102教室で景品交換！</p>
</div>

<div align="center">

<img src="img/spot.png" style="width:100%;height:100%;">

</div>



<!--<a id="reset_btn" class="btn btn-danger btn-block btn-lg radius2" href="javascript:Main.reset();" style="margin-bottom:30px;">Reset</a>
<img src="img/intro.png" style="width:95%;height:100%;">
<!--
<p style="color:#333399;text-shadow:3px 3px 3px rgba(0, 0, 0, 0.2)">今年の五月祭「東大制覇ラリー〜館コレ〜」のご利用、誠にありがとうございました。
スタンプ詳細ページでめいちゃんの画像をクッリクすると、スタンプのダウロードができます〜
</p>!-->


<!--<a class="btn btn-danger btn-block btn-lg radius2" href="kokosil.html" style="margin-bottom:30px;">
ココシルロゴ
</a>-->


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
