<?php
  require_once "connectVar.php";
  $check = 0;
  $check2=0;
  $check1 = 0;
  if(isset($_POST['Mainname']))
  {
    $Mainname=$_POST['Mainname'];
    $sql = "SELECT * FROM `info` WHERE `Mainname` = '".$Mainname."'";
    $result = $conn->query($sql);
    $rowcount=mysqli_num_rows($result);
    if($rowcount == 0)
	$check1++;
  }
  else
    $check++;
  if(isset($_POST['Teammate']))
    $Teammate=$_POST['Teammate'];
  else
    $check++;
  if(isset($_POST['Ctitle']))
    $Ctitle=$_POST['Ctitle'];
  else
    $check++;
  if(isset($_POST['Etitle']))
    $Etitle=$_POST['Etitle'];
  else
    $check++;
  if(isset($_FILES["Poster"]["name"])&&$_FILES["Poster"]["name"]!=""){
     if(isset($_POST['group']))
        $Poster = $_POST['group'].".jpg";
    //$Poster=$_FILES["Poster"]["name"];
    if($_FILES["Poster"]["type"]=="image/jpeg"){
    move_uploaded_file($_FILES["Poster"]["tmp_name"],"./pupload/".$Poster) or die("Problems with upload");
  /*  $src = imagecreatefromjpeg("./pupload/".$_FILES['Poster']['name']);
    // 取得來源圖片長寬
    $src_w = imagesx($src);
    $src_h = imagesy($src);

    // 假設要長寬不超過90
    if($src_w > $src_h){
      $thumb_w = 700;
      $thumb_h = intval($src_h / $src_w * 1000);
    }else{
      $thumb_h = 1000;
      $thumb_w = intval($src_w / $src_h * 700);
    }

    // 建立縮圖
    $thumb = imagecreatetruecolor($thumb_w, $thumb_h);

    // 開始縮圖
    imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);

    // 儲存縮圖到指定 thumb 目錄
    imagejpeg($thumb, "./thumb/".$_FILES['Poster']['name']);
*/
    // 複製上傳圖片到指定 images 目錄
    //copy($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);
	}
    else{
	$check++;
	$check2=-1;
?>
 <script type="text/javascript">
        alert("海報格式為JPG檔，請重新上傳，謝謝");
  </script>
<?php
    }
}
  if(isset($_FILES["Report"]["name"]) && $_FILES["Report"]["name"]!=""){
    if(isset($_POST['group']))
	$Report = $_POST['group'].".pdf";
    //$Report=$_FILES["Report"]["name"];
    move_uploaded_file($_FILES["Report"]["tmp_name"],"./rupload/".$Report) or die("Problems with upload");
    }
  //echo $Mainname.$Teammate.$Ctitle.$Etitle.$Poster.$Report;
  if(isset($_POST['Submit']) && $_POST['Submit']=="Send"){
    if($check1 == 0){ ?>
  <script type="text/javascript">
	alert("已經繳交囉! 請點選自己組別進入修改，謝謝");
  </script>
    <?php }
    if( $check == 0 && $check1 != 0){
      if(isset($Poster) && isset($Report))
      $sql = "INSERT INTO `info`(`Mainname`, `Teammate`, `Ctitle`, `Etitle`, `Poster`, `Report`) VALUES ('".$Mainname."','".$Teammate."','".$Ctitle."','".$Etitle."','".$Poster."','".$Report."')";
    else if(isset($Poster))
      $sql = "INSERT INTO `info`(`Mainname`, `Teammate`, `Ctitle`, `Etitle`, `Poster`) VALUES ('".$Mainname."','".$Teammate."','".$Ctitle."','".$Etitle."','".$Poster."')";
    else if(isset($Report))
      $sql = "INSERT INTO `info`(`Mainname`, `Teammate`, `Ctitle`, `Etitle`, `Report`) VALUES ('".$Mainname."','".$Teammate."','".$Ctitle."','".$Etitle."','".$Report."')";
    else
      $sql = "INSERT INTO `info`(`Mainname`, `Teammate`, `Ctitle`, `Etitle`) VALUES ('".$Mainname."','".$Teammate."','".$Ctitle."','".$Etitle."')";
     // $sql = "INSERT INTO `info`(`Mainname`, `Teammate`, `Ctitle`, `Etitle`, `Poster`, `Report`) VALUES ('".$Mainname."','".$Teammate."','".$Ctitle."','".$Etitle."','".$Poster."','".$Report."')";
      $conn->query($sql) or die("dd");
    }
  }
  if(isset($_POST['Submit']) && $_POST['Submit']=="Update"){
   $id = $_POST['ID']; 
   if($check == 0 && $check2 == 0) {
    if(isset($Poster) && isset($Report))
      $sql = "UPDATE `info` SET `Mainname`= '".$Mainname."',`Teammate`= '".$Teammate."',`Ctitle`= '".$Ctitle."',`Etitle`= '".$Etitle."',`Poster`='".$Poster."',`Report`= '".$Report."' WHERE `Id` = '".$id."'";
    else if(isset($Poster))
      $sql = "UPDATE `info` SET `Mainname`= '".$Mainname."',`Teammate`= '".$Teammate."',`Ctitle`= '".$Ctitle."',`Etitle`= '".$Etitle."',`Poster`='".$Poster."' WHERE `Id` = '".$id."'";
    else if(isset($Report))
      $sql = "UPDATE `info` SET `Mainname`= '".$Mainname."',`Teammate`= '".$Teammate."',`Ctitle`= '".$Ctitle."',`Etitle`= '".$Etitle."',`Report`= '".$Report."' WHERE `Id` = '".$id."'";
    else
      $sql = "UPDATE `info` SET `Mainname`= '".$Mainname."',`Teammate`= '".$Teammate."',`Ctitle`= '".$Ctitle."',`Etitle`= '".$Etitle."' WHERE `Id` = '".$id."'";
      $conn->query($sql);
 } }
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CSE </title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- google fonts-->

<link href='https://fonts.googleapis.com/css?family=Leckerli+One|Metrophobic' rel='stylesheet' type='text/css'>

<a href="#" class="icon_list" data-js="list">
  <span>• -</span>
  <span>• -</span>
  <span>• -</span>
</a>
<!-- <button class="button-one" onclick="alert('此為第一次上傳使用，欲更新檔案，請選擇組別進入重新編輯');javascript:location.href='./uppage/index.php'">上傳</button> -->

<?php
  $sql = "SELECT * FROM `info` WHERE `Project_Group` LIKE '%A%' ORDER BY CAST(SUBSTR(`Project_Group`,2) AS UNSIGNED) ASC";
  $result = $conn->query($sql);
  $sql1 = "SELECT * FROM `info` WHERE `Project_Group` LIKE '%B%' ORDER BY CAST(SUBSTR(`Project_Group`,2) AS UNSIGNED) ASC";
  $result1 = $conn->query($sql1);

?>
<div class="wrapper">
  <div class="wrapper_inner">
    <!-- Gallery -->
    <section class="gallery">
       
    <?php
      $count = 1;
      while($row = $result->fetch_array()){

    ?>
      <div class="gallery_item">
        <span class="gallery_item_preview">
          <a href="#" data-js="<?php echo $count; ?>">

            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            
            <img src="./thumb/<?php echo $row[5]; ?>" alt="" />
            <span>
            <h3><?php echo $row[7]."_".$row[3];?></h3>
            <p>組長 : <?php echo $row[1];?><br>組員 : <?php echo $row[2];?></p>
            </span>
          </a>
        </span>

        <div data-lk="<?php echo $count; ?>" class="gallery_item_full">
          <div class="box">
            <img src="./pupload/<?php echo $row[5]; ?>" alt="" />
            <h2><?php echo $row[4];?></h2>
            <p>組別 : <?php echo $row[7];?> <br>專題中文名稱 : <?php echo $row[3];?><br>專題英文名稱 : <?php echo $row[4];?><br>組長 : <?php echo $row[1];?><br>組員 : <?php echo $row[2];?><br>書面報告 : <a href="./rupload/<?php echo $row[6];?>"><?php echo $row[6];?></a></p>
            <a href="./uppage/index.php?Main=<?php echo $row[1];?>"><img src="./icon/update.png" style="width: 8%;"></a>
          </div>
        </div>
      </div>
<?php 
  $count++;
} ?>
<br>
<?php
     // $count = 1;
      while($row = $result1->fetch_array()){

    ?>
      <div class="gallery_item">
        <span class="gallery_item_preview">
          <a href="#" data-js="<?php echo $count; ?>">

            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            
            <img src="./thumb/<?php echo $row[5]; ?>" alt="" />
            <span>
            <h3><?php echo $row[7]."_".$row[3];?></h3>
            <p>組長 : <?php echo $row[1];?><br>組員 : <?php echo $row[2];?></p>
            </span>
          </a>
        </span>

        <div data-lk="<?php echo $count; ?>" class="gallery_item_full">
          <div class="box">
            <img src="./pupload/<?php echo $row[5]; ?>" alt="" />
            <h2><?php echo $row[4];?></h2>
            <p>組別 : <br>專題中文名稱 : <?php echo $row[3];?><br>專題英文名稱 : <?php echo $row[4];?><br>組長 : <?php echo $row[1];?><br>組員 : <?php echo $row[2];?><br>書面報告 : <a href="./rupload/<?php echo $row[6];?>"><?php echo $row[6];?></a></p>
            <a href="./uppage/index.php?Main=<?php echo $row[1];?>"><img src="./icon/update.png" style="width: 8%;"></a>
          </div>
        </div>
      </div>
<?php 
  $count++;
} ?>


  <!--      
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="2">
            <svg fill="#5690F7" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/b8fd8b5382cce0e5be44bd1245ea2cf4/tumblr_n2k138YEtG1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple Video</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="2" class="gallery_item_full">
          <div class="box">

            <div class="video">
              <iframe src="https://www.youtube.com/embed/gLg6qxkQ94A"></iframe>
            </div>

            <h3>Example Youtube video</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>

        
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="3">
            <svg fill="#5690F7" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://24.media.tumblr.com/5c73892a883adf41e9b8b7fe807e19b8/tumblr_n2k10foRBd1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple Video 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="3" class="gallery_item_full">
          <div class="box">
            <div class="video">
              <iframe src="//player.vimeo.com/video/89918113"></iframe>    
            </div>
            <h3>Example Vimeo video</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>


       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="4">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/72ff371588fd911cf7725394740c62a0/tumblr_n2k15mq4xy1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="4" class="gallery_item_full">
          <div class="box">
            <img src="https://25.media.tumblr.com/72ff371588fd911cf7725394740c62a0/tumblr_n2k15mq4xy1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>      


       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="5">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/e615708905cc9df81f901c06ae4afe1e/tumblr_n21ltnVLtz1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>

        </span>
         
        <div data-lk="5" class="gallery_item_full">
          <div class="box">
            <img src="https://25.media.tumblr.com/e615708905cc9df81f901c06ae4afe1e/tumblr_n21ltnVLtz1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>



       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="6">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/6c0e95d27b8509096274f244ff5aeea9/tumblr_n21lusI21V1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="6" class="gallery_item_full">
          <div class="box">
            <img src="https://25.media.tumblr.com/6c0e95d27b8509096274f244ff5aeea9/tumblr_n21lusI21V1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>

       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="7">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://24.media.tumblr.com/bb592565a7d8c4f004973fe3045cac6f/tumblr_n21lvqbJ2m1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="7" class="gallery_item_full">
          <div class="box">
            <img src="https://24.media.tumblr.com/bb592565a7d8c4f004973fe3045cac6f/tumblr_n21lvqbJ2m1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>


       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="8">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/0a4075c0b36aa37ddbd85d4e75afbeca/tumblr_n21lwpVo3F1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="8" class="gallery_item_full">
          <div class="box">
            <img src="https://25.media.tumblr.com/0a4075c0b36aa37ddbd85d4e75afbeca/tumblr_n21lwpVo3F1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>

       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="9">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 175.81699,28.832771 176.47059,0.72819569 z"></path>
            </svg>
            <img src="https://24.media.tumblr.com/40b727a4d9ea5164103d81590bde4ef6/tumblr_n2k0y8bxXE1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>

        </span>
         
        <div data-lk="9" class="gallery_item_full">
          <div class="box">
            <img src="https://24.media.tumblr.com/40b727a4d9ea5164103d81590bde4ef6/tumblr_n2k0y8bxXE1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>



       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="10">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://25.media.tumblr.com/b8fd8b5382cce0e5be44bd1245ea2cf4/tumblr_n2k138YEtG1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="10" class="gallery_item_full">
          <div class="box">
            <img src="https://25.media.tumblr.com/b8fd8b5382cce0e5be44bd1245ea2cf4/tumblr_n2k138YEtG1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>

       
      <div class="gallery_item">
         
        <span class="gallery_item_preview">
          <a href="#" data-js="11">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://24.media.tumblr.com/f74ff1d9acdf8c43cd1897e01bc669e6/tumblr_n2k114hDQX1st5lhmo1_1280.jpg" alt="" /><span>
            <h3>Exmaple photo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.</p>

            </span></a>
        </span>
         
        <div data-lk="11" class="gallery_item_full">
          <div class="box">
            <img src="https://24.media.tumblr.com/f74ff1d9acdf8c43cd1897e01bc669e6/tumblr_n2k114hDQX1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div>
      </div>


      <div class="gallery_item">

        <span class="gallery_item_preview">

          <a href="#" data-js="12">
            <svg fill="#f55" class="gallery_top" viewbox="0 3 60 20">
              <path d="M 0.65359477,1.3817905 C 60.201925,8.44316 121.92863,11.583451 175.81699,28.832771 l 0.6536,-28.10457531 z"></path>
            </svg>
            <img src="https://24.media.tumblr.com/57a652bfb91e06d3d1f596c0aa5f7871/tumblr_n2k120WsWM1st5lhmo1_1280.jpg" alt="" />
            <span>
              <h3>Exmaple photo</h3>
            </span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          </a>
        </span>

        <div data-lk="12" class="gallery_item_full">
          <div class="box">
            <img src="https://24.media.tumblr.com/57a652bfb91e06d3d1f596c0aa5f7871/tumblr_n2k120WsWM1st5lhmo1_1280.jpg" alt="" />
            <h3>Example image</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore rem minima saepe itaque animi fuga consequuntur. Praesentium dolorum neque autem nihil nobis quam animi ullam eos tempora quia eius aliquid?</p>
          </div>
        </div> -->
      </div>
    </section>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
