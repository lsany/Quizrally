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
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

    <script src="js/kokosil-client.js"></script>
    <script src="js/stamprally-api.js"></script>
    <script src="js/jquery.confirm.js"></script>
    <script src="js/map.js"></script>
    

    <script>
    function quiz_list()
    {
      var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
      var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags', registeredTags);
      var length;
      if(registeredTags==null)length=0;
      else length=registeredTags.length;
      location.href='quiz_list.php?user_id='+user_id+'&length='+length;
    }
    /*
    function finish()
    {

      var allTags=KokosilClient.getContext('mayfestival_stamprally_allTags', allTags);
      var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
      var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
      if(registeredTags.length!=allTags.length){
        var r=confirm("本当に解答を終了しますか？\n一度終了すると解答できなくなります！");
        if(r==true)
        {
          for(var i=0; i<allTags.length;i++){
            var tag=allTags[i];
            if(!checkRegistered(tag)){
              //KokosilClient.unregisterUcodeNotification(tag.ucode);
              registeredTags.push(tag);
              KokosilClient.setContext('mayfestival_stamprally_registeredTags',  registeredTags);
              
              ucode=tag.ucode;
              var registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
              registereducode.push(ucode);
              KokosilClient.setContext('mayfestival_stamprally_registereducode',  registereducode);
            }
            //KokosilClient.unregisterUcodeNotification(tag.ucode);
          }
          //location.href="result.php?user_id="+user_id;
          location.href='map.php?user_id='+user_id;
        }
      else ;
    }
    else {
      location.href="result.php?user_id="+user_id;
    }
  }

function checkRegistered(currentTag){
      var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
         for(var i=0;i<registeredTags.length;i++){
            if(JSON.stringify(currentTag)==JSON.stringify(registeredTags[i])){
                return true;
            }
        }
        return false;
    }
  */

    </script>
  </head>


<!--<body onLoad="javascript:Main.initMap();">!-->
<body>

<div class="header_map">
<h1><a href="index.html"><span class="glyphicon glyphicon-chevron-left"></span>
TOP</a></h1>
</div>

<?php
$conn=mysql_connect("localhost","root","komaba2014");
mysql_set_charset("utf8");
mysql_select_db("Komaba_Festival");

//$user_id=$_GET['user_id'];
mysql_query("INSERT INTO Users (user_id) VALUES ('{$_GET['user_id']}')");
if (!$conn){
  die('Could not connect:'.mysql_error());
}
$score=0;
$result = mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");
$row_res= mysql_fetch_array($result);
for($i=1;$i<=10;$i++){
  $result_user=$row_res[quiz.$i];
  $answer = mysql_query("SELECT * From Quiz where id = $i");
  $row_ans=mysql_fetch_array($answer);
  if($result_user!=0){
    $score++;
  }
}

?>

<div class="stamp_area_head count">
  
   クイズ：<font size=4, color='yellow'><?php echo "$score"; ?></font> 問解答
  <br/>
</div>

<div class="map_area" style="margin-bottom:115px;">
<div class="map">

<img src="img/map.png">

<?php
$result = mysql_query("SELECT * From Users where user_id = '{$_GET['user_id']}'");
$row_res= mysql_fetch_array($result);

$result_user=$row_res["quiz1"];
if($result_user!=0)
  echo "
<div class='s-1'>
    <img src='img/mapicon-on1.png'>
</div>
";
else echo "
<div class='s-1'>
    <img src='img/mapicon-off1.png' >
</div>
  ";
  $result_user=$row_res["quiz2"];
if($result_user!=0)
  echo "
<div class='s-2'>
    <img src='img/mapicon-on2.png'>
</div>
";
else echo "
<div class='s-2'>
    <img src='img/mapicon-off2.png' >
</div>
  ";
  $result_user=$row_res["quiz3"];
if($result_user!=0)
  echo "
<div class='s-3'>
    <img src='img/mapicon-on3.png'>
</div>
";
else echo "
<div class='s-3'>
    <img src='img/mapicon-off3.png' >
</div>
  ";
  $result_user=$row_res["quiz4"];
if($result_user!=0)
  echo "
<div class='s-4'>
    <img src='img/mapicon-on4.png'>
</div>
";
else echo "
<div class='s-4'>
    <img src='img/mapicon-off4.png' >
</div>
  ";
  $result_user=$row_res["quiz5"];
if($result_user!=0)
  echo "
<div class='s-5'>
    <img src='img/mapicon-on5.png'>
</div>
";
else echo "
<div class='s-5'>
    <img src='img/mapicon-off5.png' >
</div>
  ";

  $result_user=$row_res["quiz6"];
  if($result_user!=0)
  echo "
<div class='s-6'>
    <img src='img/mapicon-on6.png'>
</div>
";
  $result_user=$row_res["quiz7"];
  if($result_user!=0)
  echo "
<div class='s-7'>
    <img src='img/mapicon-on7.png'>
</div>
";

$result_user=$row_res["quiz8"];
  if($result_user!=0)
  echo "
<div class='s-8'>
    <img src='img/mapicon-on8.png'>
</div>
";

$result_user=$row_res["quiz9"];
  if($result_user!=0)
  echo "
<div class='s-9'>
    <img src='img/mapicon-on9.png'>
</div>
";

$result_user=$row_res["quiz10"];
  if($result_user!=0)
  echo "
<div class='s-10'>
    <img src='img/mapicon-on10.png'>
</div>
";

echo "
</div>
</div>
<div class='link_area'>
<a class='btn btn-danger btn-lg' onclick='quiz_list();'>
クイズ一覧
</a>
";

$q=$row_res["flag_finish"];




/*if($q==0&&$score!=10)
  echo "
<a class='btn btn-danger btn-lg' onclick='finish();'>
クイズ終了
</a>
";
else 
  echo "
<a class='btn btn-danger btn-lg' onclick='finish();'>
景品交換！
</a>
";*/
  
mysql_close();
?>

<!--
<a class="btn btn-danger btn-lg" id="finish_button" onclick="finish();">
クイズ終了
</a>
!-->

<a id="finish_button" class="btn btn-danger btn-lg">クイズ終了</a>
<script>
var allTags=KokosilClient.getContext('mayfestival_stamprally_allTags', allTags);
var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
var user_id=KokosilClient.getContext('mayfestival_stamprally_user');
var registereducode= KokosilClient.getContext('mayfestival_stamprally_registereducode');
var ucode;
$("#finish_button").confirm({
            title: "こまっけろ:",
            text: "本当に解答を終了しますか？<br/>終了すると景品交換ができます。<br/>でも残りのクイズを解答できなくなりますよ！",
            confirm: function(button) {
              //if(allTags==null)confirm("asd");
              //confirm(user_id);
            for(var i=0; i<allTags.length;i++){

              var tag=allTags[i];

              if(!checkRegistered(tag)){
                registeredTags.push(tag);
                KokosilClient.setContext('mayfestival_stamprally_registeredTags',  registeredTags);
                ucode=tag.ucode;
                registereducode.push(ucode);
                KokosilClient.setContext('mayfestival_stamprally_registereducode',  registereducode);
              }
            }
            //window.location.Reload();
            //top.location.href='map.php?user_id='+user_id;
            //location.href='map.php?user_id='+user_id;
            //alert("zsf");

            window.Main.onResume();
          },
          cancel: function(button) {},
          confirmButton: "クイズ終了",
          cancelButton: "キャンセル"
        });

function checkRegistered(currentTag){
      var registeredTags=KokosilClient.getContext('mayfestival_stamprally_registeredTags');
         for(var i=0;i<registeredTags.length;i++){
            if(JSON.stringify(currentTag)==JSON.stringify(registeredTags[i])){
                return true;
            }
        }
        return false;
    }
</script>

</div>

<footer >
  <a id="finish" href="javascript:Main.launchQr();" class="qr">QR起動</a>
</footer>



</body>
</html>