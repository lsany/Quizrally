<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>クイズラリー</title>
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
    <script src="js/quiz.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  <script>
function submit_result()
{
    user_id='<?php echo $_GET['user_id'];?>';
    type='<?php echo $_GET['type'];?>';
    id='<?php echo $_GET['id'];?>';
      for(i=1;i<=4;i++)
      {
        if(document.all.answer[i-1].checked)
        {answer=i;break;}
      }
      location.href='thanks.php?user_id='+user_id+'&type='+type+'&id='+id+'&answer='+answer;
}
</script>

  </head>


<!--<body onload="javascript:Main.registerStampInfo();">!-->
<body>

<!--
<header>
<h1><a href="map.html"><span class="glyphicon glyphicon-chevron-left"></span>
MAP</a></h1>

</header>
-->

<header>
<h1>&nbsp;</h1>

</header>


<?php //echo $_GET['id'];
   
    if(isset($_GET['user_id'])){
        //$conn=mysql_connect("localhost","root","");
        $conn=mysql_connect("localhost","root","komaba2014");
        mysql_set_charset('utf8');
        mysql_select_db("Komaba_Festival");
        if (!$conn){
             die('Could not connect: ' . mysql_error());
        }
        $result = mysql_query("SELECT * From Quiz where id = '{$_GET['id']}' "); //where building = '{$_GET['id']}' 
        $row=mysql_fetch_array($result);
        echo "
        <h2 align='center'>$row[quizname]</h2>
        <div class='quiz_text'>
              
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[quiztext]</p>
              </div>";      
    };
    ?>

<form role="form" id='quiz' method="post">
  <div class="form-group">
    <table align="center">
      <tr>
        <td>
          <input type="radio" value="A" name="answer"/>
        </td>
        <td>
          <?php echo "1." . $row["option_a"]."";?>
        </td>
      </tr>
      <br/>  
      <tr>
        <td>               
          <input type="radio" value="B" name="answer"/>
        </td>
        <td>
          <?php echo "2." . $row["option_b"]."";?> 
        </td>
      </tr>
      <br/>
      <tr>
        <td>  
          <input type="radio" value="C" name="answer"/>
        </td>
        <td>
          <?php echo "3." . $row["option_c"]."";?> 
        </td>
      </tr>
      <br/>
      <tr>
        <td>  
          <input type="radio" value="D" name="answer"/>
        </td>
        <td>
          <?php echo "4." . $row["option_d"]."";?> 
        </td>
      </tr>
      <br/>
    </table>

    <br/>
      <input type="button" value="提出" onclick="submit_result();" class="btn btn-danger btn-block btn-lg radius2" />
    </div>

<?php mysql_close();?> 

<!--container-->







</body>
</html>