<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>
    </title>
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
        <tr >
          <td width="25%">
            <?php 
            echo "
            <a href='quiz_list.php?user_id={$_GET['user_id']}&length={$_GET['length']}'><span class='glyphicon glyphicon-chevron-left'></span>
              戻る</a>";
              ?>
          </td>
          <td width="25%">
          </td>
        </tr>
      </table>
    </h1>
  </header>

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
        <h2 align='center'>$row[quizname]</h2>
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
    </td></tr><br>                 
    <tr><td>
    <?php echo "2." . $row["option_b"]."";?>
    </td></tr><br>
    <tr><td>
    <?php echo "3." . $row["option_c"]."";?> 
    </td></tr><br>
    <tr><td>
    <?php echo "4." . $row["option_d"]."";?> 
    </td></tr>
  </table>
  <table border="0px" align="center">
    <tr>
      <td width="50%" align="center">
        <?php 
          echo "
          <table>
          <tr>
          <td><h3>貴方の答え：</h3></td>
          <td><h3><font color='#333333'>$q</font></h3></td>
          </tr>";
        ?>
        <br>
        <?php 
          if($length==10||$flag_finish==true)
          echo "
        <tr>
        <td><h3>正解：</h3></td>
        <td><h3><font color='#333333'>$row[answer]</font></h3></td>
        </tr>
        </table>";
        ?>
      
        <?php
        echo "<br/>";
        /*
        if($length==10)
        {
          if($q == $row["answer"]){
            echo "<h3><font color='#FF00FF'>○</font></h3>";
          }else{
            echo "<h3><font color='#5C5C5C'>×</font></h3>";
          }
        }
        */
        ?>
      </td>
    </tr>
  </table>
<br/>
<?php
echo "
    <a class='btn btn-danger btn-block btn-lg radius2' href='answer_detail.php?user_id={$_GET['user_id']}&value=$q_id&length=$length'>
    詳しい解答  
    </a>
    ";
?>
</body>
</html>