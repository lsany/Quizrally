<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>答えまくれ！クイズラリー</title>
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
    echo "
    <header>
    <h1>
    <table border='0px' width='100%'> 
    <tr>
    <td width='25%'>
    <a href='quiz_detail.php?value={$_GET['value']}&user_id={$_GET['user_id']}&length={$_GET['length']}'><span class='glyphicon glyphicon-chevron-left'></span>戻る</a>
    </td>
    <td align='center'>
    解説 
    </td>
    <td width='25%'>
    </td>
    </tr>
    </table>
    </h1>
    </header>
    ";
    ?>
    <?php 
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
    $row=mysql_fetch_array($result);
    $length=$_GET['length'];
    if($length==10||$flag_finish==true)
        echo "
    <div class='quiz_text' style='margin-bottom:120px'>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[detail]</p>
    </div>
    ";
    else
        echo "
    <div class='quiz_text' style='margin-bottom:120px'>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;解答を終了すると、ここでクイズの解答を見ることができます。</p>
    </div>
    ";
    mysql_close();
    ?>

<?php
echo "
<a class='btn btn-danger btn-block btn-lg radius2 link_area4' href='quiz_detail.php?value={$_GET['value']}&user_id={$_GET['user_id']}&length={$_GET['length']}'>戻ります！</a>
";
?>

</body>
</html>