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
   
      if(isset($_GET['user_id'])){
        $conn=mysql_connect("localhost","root","komaba2014");
        mysql_set_charset('utf8');
        mysql_select_db("Komaba_Festival");
        if (!$conn){
             die('Could not connect:'.mysql_error());
        }

        $q_id=$_GET['value'];

        $result = mysql_query("SELECT * From Quiz where id = $q_id"); 
        $row=mysql_fetch_array($result);
        echo "
        <header>
        <h1>
        <table border='0px' width='100%'> 
        <tr>
        <td width='25%'>
        <a href='quiz_list.php?user_id={$_GET['user_id']}&length={$_GET['length']}'><span class='glyphicon glyphicon-chevron-left'></span>戻る</a>
        </td>
        <td align='center'>
        $row[quizname]
        </td>
        <td width='25%'>
        </td>
        </tr>
        </table>
        </h1>
        </header>
        
        <div class='quiz_text'>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[quiztext]</p>
        </div>";
        $user_info= mysql_query("SELECT * From Users
        where user_id = '{$_GET['user_id']}'");
        $user_result=mysql_fetch_array($user_info);
        $q = $user_result["quiz".$q_id];
        $length=$_GET['length'];

        $flag_finish = $user_result["flag_finish"];

        mysql_close();               
       };
    ?>
  <table align="center">
      <tr><td>
    <?php echo "1." . $row["option_a"]."";?>
    </td></tr><br/>                 
    <tr><td>
    <?php echo "2." . $row["option_b"]."";?>
    </td></tr><br/>
    <tr><td>
    <?php echo "3." . $row["option_c"]."";?> 
    </td></tr><br/>
    <tr><td>
    <?php echo "4." . $row["option_d"]."";?> 
    </td></tr>
  </table>
        <?php 
          echo "
          <div class='answer_area' style='margin-bottom:20px;'>
          <p class='answer'>あなたの答え：$q</p>
          </div>
          ";
        ?>
        <?php 
          if($length==10||$flag_finish==true)
          echo "
        <div class='answer_area' style='margin-bottom:20px;'>
        <p class='answer'>正&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;解：$row[answer]</p>
        </div>
        ";
        ?>
<?php
echo "
    <a class='btn btn-danger btn-block btn-lg radius2 link_area4' href='answer_detail.php?user_id={$_GET['user_id']}&value=$q_id&length=$length'>
    解説  
    </a>
    ";
?>
</body>
</html>