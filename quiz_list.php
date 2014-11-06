<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>クイズラリー•クイズ一覧</title>
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


<!--<body onLoad="javascript:Main.initStampInfo();">!-->
<body>

<header>
  <h1>
    <table border="0px" width="100%"> 
      <tr>
        <td width="25%">
          <a href="map.html">
          <span class="glyphicon glyphicon-chevron-left"></span>
            MAP
          <span id="dl_intro" style="color:white;font-size:14px;"></span>
          <span id="finishment" style="color:white;font-size:14px;"></span>
          </a>
        </td>

        <td align="center">
            クイズ一覧
        </td>

        <td width="25%">
        </td>
      </tr>
    </table>
  </h1>
</header>


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
              echo " 
              
              
              <a class='btn btn-danger btn-block btn-lg radius2'>
              <table>
              <tr>
              <td width='25%' align='left'>{$row["quizname"]}:</td>
              <td width='73%' align='left'>未解答です！</td>
              ";


            }else{
              $rest = substr($row["building"], "0", "30");
              echo " 
              
               <a class='btn btn-danger btn-block btn-lg radius2' href='quiz_detail.php?value=$q_id&user_id={$_GET['user_id']}&length=$length' >
               <table>
               <tr>
               <td width='25%' align='left'>{$row["quizname"]}:</td>
               <!--<td width='73%' align='left'>$rest</td>-->
               <td width='73%' align='left'>$rest</td>
               ";
            }

            mysql_close();
            };
              if ($q == "0"||$q==null) {
                echo "
                <td width='2%' align='left'><font color='#FF00FF' size='5'>?</font></td>
                ";
              }else{
                if($length==10||$flag_finish==true)
                {
                  if ($q == $row["answer"]) {
                    echo "<td width='2%' align='left'><font color='#EE0000' size='5'>◯</font></td>";
                  }else {
                    echo "<td width='2%' align='left'><font color='#5C5C5C' size='5'>X</font></td>";
                  }
                }
                else echo "<td width='2%' align='left'><font color='#FFF' size='5'>>></font></td>";
              }
    echo "
    </tr>
      </table>
      </a>
      
      
    ";
  }
?>
<br/>


</body>
</html>
