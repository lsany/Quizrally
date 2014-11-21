<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>答えまくれ！クイズラリー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/base.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/kokosil-client.js"></script>
    <script src="js/stamprally-api.js"></script>

  </head>


<body>
<?php
//session_start();
   //echo $_POST['q1'].$_POST['q2'].$_POST['q3'].$_POST['q4'].$_POST['q5'].$_POST['q6'].$_POST['q7'];
    if(isset($_POST['q1'])&&isset($_POST['q2'])&&isset($_POST['q3'])&&isset($_POST['q4'])&&isset($_POST['q5'])&&isset($_POST['q6'])&&isset($_POST['q7'])&&isset($_POST['q8'])){

        //$conn=mysql_connect("localhost","root","");
        $conn=mysql_connect("localhost","root","komaba2014");
        mysql_set_charset('utf8');
        mysql_select_db("Komaba_Festival");
        if ($conn){
          /*
           $sql = 'INSERT INTO questionNaire'.
               '(user_id,q1, q2, q3,q4, q5, q6,q7,q8,time) '.
               'VALUES ( "'.$_POST['user_id'].'","'.$_POST['q1'].'","'.$_POST['q2'].'","'.$_POST['q3'].'","'.$_POST['q4'].'","'.$_POST['q5'].'","'.$_POST['q6'].'","'.$_POST['q7'].'","'.$_POST['q8'].'",now()+INTERVAL 9 HOUR)';
                */

            //echo $sql;
               mysql_query("INSERT INTO Users (user_id) 
          VALUES ('{$_POST['user_id']}')
          ON duplicate key update user_id='{$_POST['user_id']}'");  // insert or update
               $query="UPDATE Users SET age = '{$_POST['q1']}', gender='{$_POST['q2']}', occupation='{$_POST['q3']}', phone_type='{$_POST['q4']}', ucode_type='{$_POST['q5']}',accompany='{$_POST['q6']}',know_it_from='{$_POST['q7']}', enjoy='{$_POST['q8']}' WHERE user_id='{$_POST['user_id']}'";
            $insert_sql = mysql_query($query);
            //setcookie('isAnswered',1);
            if(! $insert_sql){
              die('Could not enter data: ' . mysql_error());
            }
        }
         mysql_close();

         
         
    }
  ?>

<?php
echo"
<div class='header_map'>
<h1>
<a href='map.php?user_id={$_POST['user_id']}'><span class='glyphicon glyphicon-chevron-left'></span>MAP</a>
</h1>
</div>
";
?>

<br/>
<div class='result' style='width:80%; margin-bottom:120px;'>
<p style='font-size:15px; margin-bottom:20px;'>アンケートへの協力ありがとうございます！</p>
</br>
<p style='font-size:20px; margin-bottom:20px;'><font size=4, color='yellow'>ボーナスポイントゲット！！</font></p>

<div align="right">
<img src="img/komakero2.png" style="width:30%;height:30%;">
</div>

</div>
<?php
//echo "'{$_POST['user_id']}'";
echo"
<a class='btn btn-danger btn-block btn-lg radius2 link_area4' href='map.php?user_id={$_POST['user_id']}'>戻ります！</a>
";
?>

</body>
</html>
