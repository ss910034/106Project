<?php
    // Last Modified Day : 2012.09.10
    //連接資料庫的參數
    $host = "localhost";    
    $user = "root";     
    $pass = "m10460074"; 
    $db = "Project";       
    $conn = mysqli_connect( $host, $user, $pass, $db );    
    if(!$conn){ //判斷是否已連上：上面的指令是不是有回傳值
        echo mysqli_connect_error();
        exit();
    }
    
    mysqli_query($conn, "set names utf8");  
    //設定MySQL資料回傳的編碼：沒有設定的話，資料可能會出現亂碼
    
    function clean($str) {
        if(!get_magic_quotes_gpc()) {
            $str = addslashes($str);
        }
        $str = strip_tags(htmlspecialchars($str));
        return $str;
    }
?>
