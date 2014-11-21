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

echo"
<header>
        <h1>
        <table border='0px' width='100%'> 
        <tr>
        <td width='25%'>
        <a href='map.php?user_id={$_GET['user_id']}'><span class='glyphicon glyphicon-chevron-left'></span>MAP</a>
        </td>
        <td align='center'>
        クイズ一覧
        </td>
        <td width='25%'>
        </td>
        </tr>
        </table>
        </h1>
        </header>
";
?>

<div class="list-group">
  <?php
  // 繰り返す10個のクイズを出力する
  $a = array(1,2,3,4,5,6,7,8,9,10);
  foreach ($a as $q_id) {
        if(isset($_GET['user_id'])){
        $conn=mysql_connect("localhost","root","komaba2014");
            mysql_set_charset("utf8");
            mysql_select_db("Komaba_Festival");
            if (!$conn){
                 die('Could not connect:'.mysql_error());
            }

            $result = mysql_query("SELECT * From Quiz where id = $q_id"); 
            $row=mysql_fetch_array($result);

            $length=$_GET['length'];
            $user_info= mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");

            $user_result=mysql_fetch_array($user_info);

            $flag_finish = $user_result["flag_finish"];
                       
            $q = $user_result["quiz".$q_id];
            
            if ($q == "0"||$q==null) {
              echo "<a class='list-group-item list-group-item-success'>
              {$row["quizname"]}:&nbsp;未解答です！
              ";


            }else{
              $rest = substr($row["building"], "0", "30");
              echo " 
              <a href='quiz_detail.php?value=$q_id&user_id={$_GET['user_id']}&length=$length' class='list-group-item list-group-item-success'>
               {$row["quizname"]}:&nbsp;$rest
               ";
            }

            mysql_close();
            };
              if ($q == "0"||$q==null) {
                echo "
                <span class='badge'>?</span>
                ";
              }else{
                if($length==10||$flag_finish==true)
                {
                  if ($q == $row["answer"]) {
                    echo "<span class='badge'>◯</span>";
                  }else {
                    echo "<span class='badge'>X</span>";
                  }
                }
                else echo "<span class='badge'>＞＞</span>";
              }
    echo "
      </a>
    ";
  }
?>
</div>
<br/>


</body>
</html>
