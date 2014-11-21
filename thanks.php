<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>manual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/base.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/kokosil-client.js"></script>
    <script src="js/stamprally-api.js"></script>
  </head>
  

  
<body>

  <!--
<h1><a onclick="map();"><span class="glyphicon glyphicon-chevron-left"></span>
MAP</a></h1>
!-->
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
  $answer=$_GET['answer'];
  $user_id=$_GET['user_id'];
  $type=$_GET['type'];
  $id=$_GET['id'];
  $unanswered=0;
  $conn=mysql_connect("localhost","root","komaba2014");
  mysql_set_charset('utf8');
  mysql_select_db("Komaba_Festival");
  
  mysql_query("INSERT INTO Users (user_id) 
          VALUES ('$user_id')
          ON duplicate key update user_id='$user_id'");  // insert or update
  
  $query="UPDATE Users SET quiz".$id."='$answer',flag_finish = 0 WHERE user_id='$user_id'";
  mysql_query($query);

  if (!$conn){die('Could not connect: ' . mysql_error());}
  $result = mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");
  $row_res= mysql_fetch_array($result);
  for($i=1;$i<=10;$i++)
  {
    if($row_res[quiz.$i]==0)$unanswered++;  
  }
  
  echo "
  <div class='result' style='width:80%; margin-bottom:120px;'>
<p style='font-size:15px; margin-bottom:20px;'>ご回答ありがとうございます！</p>
";
if($unanswered==0)
echo "
  <div class='comp'>１０問全部解けました！</div>
";
else{
  echo "
  <p style='font-size:20px; margin-bottom:20px;'>残る<font size=4, color='yellow'>$unanswered</font>問があります。</p>
";
  if($id<5||$id==10)
  echo "
  <p style='font-size:20px; margin-bottom:20px;'>頑張りましょう！</p>
  ";
  else{
        $Quiz = mysql_query("SELECT * From Quiz where id = '{$_GET['id']}'+1 "); //where building = '{$_GET['id']}' 
        $row=mysql_fetch_array($Quiz);
        echo"
        <p style='font-size:15px; margin-bottom:20px;'>次のクイズの場所のヒント：</p>
        <div class='comp'>$row[building]</div>
        ";
      }
    }
?>
<div align="right">
<img src="img/komakero2.png" style="width:30%;height:30%;">
</div>
</div>

<?php
    if(isset($_GET['user_id'])){
        mysql_query("INSERT INTO Users (user_id) 
          VALUES ('$user_id')
          ON duplicate key update user_id='$user_id'");  // insert or update
        $query="UPDATE Users SET quiz".$id."='$answer',flag_finish = 0 WHERE user_id='$user_id'";
        mysql_query($query);
    mysql_close();
    };
?>

<?php

echo"
<a href='map.php?user_id={$_GET['user_id']}' class='btn btn-danger btn-block btn-lg radius2 link_area4'>戻ります！</a>
";

?>
<!--
<a class="btn btn-danger btn-block btn-lg radius2 link_area4" onclick="map();">戻ります！</a>
!-->
</body>
</html>