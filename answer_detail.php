<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>詳しい回答</title>
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
  </head>


<body>
    <header>
    <h1>
        <table border="0px" width="100%"> 
            <tr>
                <td width="25%">
                    <?php
                    echo "
                    <a href='quiz_detail.php?value={$_GET['value']}&user_id={$_GET['user_id']}&length={$_GET['length']}'><span class='glyphicon glyphicon-chevron-left'></span>
                    戻る</a>
                    ";
                    ?>
                </td>

                <td align="center">
                    詳しい回答
                </td>

                <td width="25%">
                </td>
            </tr>
        </table>
    </h1>
    </header>


<div class="container" style="margin-bottom:70px;">
    <div class="stamp_manual radius1" style="margin-bottom:70px; background-color:#999;">
        <div class="row">
            <div class="col-xs-12">

                <?php //echo $_GET['id'];
   
                    //if(isset($_GET['user_id'])){
                    //$conn=mysql_connect("localhost","root","");
                    $conn=mysql_connect("localhost","root","komaba2014");
                    mysql_set_charset('utf8');
                    mysql_select_db("Komaba_Festival");
                        if (!$conn){
                            die('Could not connect:'.mysql_error());
                        }

                    $user_info= mysql_query("SELECT * From Users
                        where user_id = '{$_GET['user_id']}'");
                    $user_result=mysql_fetch_array($user_info);
                    $flag_finish = $user_result["flag_finish"];
                    $result = mysql_query("SELECT * From Quiz where id = '{$_GET['value']}' "); 
                    //$result = mysql_query("SELECT * From Quiz where building = 'kou1'"); 
                    $row=mysql_fetch_array($result);
                    $length=$_GET['length'];
                    if($length==10||$flag_finish==true)
                    echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[detail]</p>";
                    else
                        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;解答を終了すると、ここでクイズの解答を見ることができます。</p>";
                    mysql_close();
                     // };

                 ?>
            </div>
        </div>
    </div>
</div>


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