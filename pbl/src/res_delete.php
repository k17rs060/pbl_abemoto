<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<?php
require_once('db_inc.php');
if (isset($_GET['STORE_ID'])){
  $STORE_ID = $_GET['STORE_ID'];
  $STORE_NAME = $_GET['STORE_NAME'];
  echo '<h2>'. $STORE_NAME . 'の店舗情報を削除しますか?</h2>';
  echo '<a href="res_delete.php?&uuid='. $STORE_ID . '">はい</a> | <a href=pb_favorg.php>いいえ</a>';
}else if (isset($_GET['uuid'])){
   $uid = $_GET['uuid'];
   $sql = "DELETE FROM t_rstinfo WHERE STORE_ID='{$uid}'";
   mysql_query($sql, $conn);
   header('Location:pb_home.php');
}else{
  echo '<h2>削除する店舗IDは与えられていません</h2>';
  echo '<a href="?do=pb_home">戻る</a>';
}
?>
