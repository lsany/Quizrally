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

  <script>
function submit_result()
{
    var user_id='<?php echo $_GET['user_id'];?>';
    var type='<?php echo $_GET['type'];?>';
    var id='<?php echo $_GET['id'];?>';
    
      for(i=1;i<=4;i++)
      {
        if(document.all.answer[i-1].checked)
        {answer=i;break;}
      }
      
      /*
      var obj=document.getElementById('quiz_option');
      var answer= obj.selectedIndex;
      */
      location.href='thanks.php?user_id='+user_id+'&type='+type+'&id='+id+'&answer='+answer;
}
</script>

  </head>

<body>



<?php 
   
    if(isset($_GET['user_id'])){
        $conn=mysql_connect("localhost","root","komaba2014");
        mysql_set_charset('utf8');
        mysql_select_db("Komaba_Festival");
        if (!$conn){
             die('Could not connect: ' . mysql_error());
        }
        $result = mysql_query("SELECT * From Quiz where id = '{$_GET['id']}' "); //where building = '{$_GET['id']}' 
        $row=mysql_fetch_array($result);
        /*echo "
        <h2 align='center'>$row[quizname]</h2>
        <div class='quiz_text'>
              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[quiztext]</p>
              </div>";  */    
    };
    mysql_close();
    ?>
<!--
      <hr>
      <select class="form-control" id="quiz_option">
      <option><?php //echo "1." . $row["option_a"]."";?></option>
      <option><?php //echo "2." . $row["option_b"]."";?></option>
      <option><?php //echo "3." . $row["option_c"]."";?></option>
      <option><?php //echo "4." . $row["option_d"]."";?></option>
      </select>
!-->
<header>
<h1 align="center"><?php echo "$row[quizname]";?></h1>

</header>

<div class='quiz_text'>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$row[quiztext]";?></p>
</div>
<form role="form" id='quiz' method="post">
  <div class="form-group">
    <table align="center">
      <tr>
        <td>
          <input type="radio" value="A" name="answer"/>
        </td>
        <td>
          <?php echo "1." . "&nbsp;".$row["option_a"]."";?>
        </td>
      </tr>
      <br/>  
      <tr>
        <td>               
          <input type="radio" value="B" name="answer"/>
        </td>
        <td>
          <?php echo "2." ."&nbsp;". $row["option_b"]."";?> 
        </td>
      </tr>
      <br/>
      <tr>
        <td>  
          <input type="radio" value="C" name="answer"/>
        </td>
        <td>
          <?php echo "3." . "&nbsp;".$row["option_c"]."";?> 
        </td>
      </tr>
      <br/>
      <tr>
        <td>  
          <input type="radio" value="D" name="answer"/>
        </td>
        <td>
          <?php echo "4." . "&nbsp;".$row["option_d"]."";?> 
        </td>
      </tr>
      <br/>
    </table>
    <br/>
      <input type="button" value="解答する" onclick="submit_result();" class="btn btn-danger btn-block btn-lg radius2 link_area4" />
</body>
</html>