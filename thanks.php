<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>manual</title>
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
<h1><a href="map.html"><span class="glyphicon glyphicon-chevron-left"></span>
MAP</a></h1>
</header>


<br/><br/>
<div  style="background-color:#551A8B; text-align:center;
  background-position:center center;
  width:80%;
  min-height:40%;
  margin: 0 auto;
  color:#ffffff;" > 
  <?php

  $answer=$_GET['answer'];
    $user_id=$_GET['user_id'];
    $type=$_GET['type'];
    $id=$_GET['id'];
    $conn=mysql_connect("localhost","root","komaba2014");
    mysql_set_charset('utf8');
    mysql_select_db("Komaba_Festival");
    if (!$conn){die('Could not connect: ' . mysql_error());}

  echo "
  <br/>
<font size='3' color='white'>ご回答ありがとうございます！</font>
";
if($id<=5)
echo "
<br/>
<br/>
<font size='2' color='yellow'>１１号館1102教室で景品交換できます!</font>
";

elseif($id<=9){
        $result = mysql_query("SELECT * From Quiz where id = '{$_GET['id']}'+1 "); //where building = '{$_GET['id']}' 
        $row=mysql_fetch_array($result);

  echo"
  <br/>
  <br/>
  <br/>
  <font size='2' color='white'>次のクイズの置く場所のヒント：</font>
  <br/>
  <font size='4' color='red'>$row[building]</font>
  ";
  }
else{
  echo"
  <br/>
  <br/>
  <br/>
  <br/>
  <font size='4' color='red'>１０問全部解けました！</font>
  ";
}
?>
<br/>
<br/>
<div align="right">
<img src="img/komakero2.png" style="width:30%;height:30%;">
</div>

</div>

<?php
    if(isset($_GET['user_id'])){
        //$conn=mysql_connect("localhost","root","");
        /*
        if exists(select * from Users where user_id= '$user_id')
        {
          echo "222222";
          mysql_query("UPDATE Users 
          SET quiz1='$answer'
          WHERE user_id='$user_id'");           
        }
        else
        {
          echo "1111111";
          mysql_query("INSERT INTO Users (user_id, quiz1, quiz2) 
          VALUES ('$user_id','0','0')");
        }*/
        /*
        mysql_query("INSERT INTO Users (user_id, quiz1, quiz2) 
          VALUES ('$user_id','0','0')
          WHERE not exists(select * from Users where user_id='user_id')");
        */
        mysql_query("INSERT INTO Users (user_id) 
          VALUES ('$user_id')
          ON duplicate key update user_id='$user_id'");  // insert or update
        $query="UPDATE Users SET quiz".$id."='$answer',flag_finish = 0 WHERE user_id='$user_id'";
        mysql_query($query);



    mysql_close();
    };

?>

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