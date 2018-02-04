<?php
  require_once '../connectVar.php';
  if(isset($_GET['Main']) ){
    $Main = $_GET['Main'];
    $sql = "SELECT * FROM `info` WHERE Mainname = '".$Main."'";
    $result = $conn->query($sql);
    $row = $result->fetch_array(); 
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Project Upload</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <script language="javascript" type="text/javascript">
    function CheckFunc()
    {
     msg = "";
     var regExp = /^[\d|a-zA-Z \.\,\!-\:]+$/;
     if(document.forms[0].Mainname.value == "")
        msg = "請輸入組長姓名";
     else if(document.forms[0].Teammate.value == "")
        msg = "請輸入隊伍成員";
     else if(document.forms[0].Ctitle.value == "")
        msg = "請輸入專題中文名稱";
     else if(document.forms[0].Etitle.value == "")
        msg = "請輸入專題英文名稱";
     else if(!regExp.test(document.forms[0].Etitle.value))
        msg = "請輸入全英文名稱";
     // else if(document.forms[0].Poster.value == "")
     //    msg = "請上傳海報檔案";
     // else if(document.forms[0].Report.value == "")
     //    msg = "請上傳專題書面報告";
     else
{
     return true;
     }
     alert(msg);
     return false;
   }
   function Check()
    {
     msg = "";
     var regExp = /^[\d|a-zA-Z \-\:\.]+$/;
     if(document.forms[0].Mainname.value == "")
        msg = "請輸入組長姓名";
     else if(document.forms[0].Teammate.value == "")
        msg = "請輸入隊伍成員";
     else if(document.forms[0].Ctitle.value == "")
        msg = "請輸入專題中文名稱";
     else if(document.forms[0].Etitle.value == "")
        msg = "請輸入專題英文名稱";
     else if(!regExp.test(document.forms[0].Etitle.value))
        msg = "請輸入全英文名稱";
     else
     {
        return true;
     }
     alert(msg);
     return false;
   }
    </script>
  <h2>中山資工專題資料上傳區</h2>
<form action="../index.php" method="post" enctype="multipart/form-data">
  <section class="left">
    <div class="input-container">
      <label for="Mainname">組長</label>
      <input type="text" name="Mainname" value="<?php if(isset($row[1])) echo $row[1];?>" />
    </div>
    <div class="input-container">
      <label for="Teammate" required>組員</label>
      <input type="text" name="Teammate" value="<?php if(isset($row[2])) echo $row[2]; ?>" />
    </div>
    <div class="input-container">
      <label for="Ctitle">專題中文名稱</label>
      <input type="text" name="Ctitle" value="<?php if(isset($row[3])) echo $row[3]; ?>"/>
    </div>
    <div class="input-container">
      <label for="Etitle">專題英文名稱</label>
      <input type="text" name="Etitle" value="<?php if(isset($row[4])) echo $row[4]; ?>"/>
    </div>
  </section>
  <section class="right">
   <!-- <div class="input-container">
      <label for="Poster">海報上傳 (Jpg格式)</label>
      <input type="file" name="Poster" id="Poster" />
    </div> -->
    <div class="input-container">
      <label for="Report">期中書面報告_比賽前 (Pdf格式)</span></label>
      <input type="file" name="Report" />
    </div>
    <input type="hidden" name="ID" value="<?php if(isset($row[0])) echo $row[0]; ?>">
    <input type="hidden" name="group" value="<?php if(isset($row[7])) echo $row[7]; ?>"
  </section>
  <div class="send-container">
    <input type="submit" name="Submit"  value="<?php if(isset($Main)) echo 'Update'; else echo 'Send'; ?>" onclick="return <?php if(isset($Main)) echo 'Check()'; else echo 'CheckFunc()'; ?>;"/>
  </div>
</form>
  
  
</body>
</html>
