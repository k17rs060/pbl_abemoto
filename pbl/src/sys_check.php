<?php
  require_once('db_inc.php'); //データベースが必要なので読み込ませる
  $u = $_POST['uid'] ;  
  $p = $_POST['pass'];  
  $sql = "SELECT * FROM tbl_user WHERE uid= '{$u}'  AND upass='{$p}'";
  $rs = mysql_query($sql, $conn);
  if (!$rs) die('エラー: ' . mysql_error());
  $row= mysql_fetch_array($rs);
  if ($row){ //Login succeeded
    $_SESSION['uid']   = $row['uid'];
    $_SESSION['uname'] = $row['uname'];
    $_SESSION['urole'] = $row['urole'];
    header('Location:index.php');   
  }else{
    header('Location:?do=sys_login');   
  }
?>