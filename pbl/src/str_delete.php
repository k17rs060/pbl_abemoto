<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<?php
require_once('db_inc.php');
session_start ();
$USER_ID = $_SESSION['USER_ID'];
if (isset($_GET['STORE_ID'])){
  $STORE_ID = $_GET['STORE_ID'];
  $STORE_NAME = $_GET['STORE_NAME'];
  echo '<h2>'. $STORE_NAME . 'の店舗情報を削除しますか?</h2>';
  echo '<a href="str_delete.php?DELETE_STORE_ID=', $STORE_ID, '&STORE_NAME=', $STORE_NAME, '&USER_ID='.$_SESSION['USER_ID'].'">はい</a> | <a href="pb_favorg.php?page_id=1&STORE_ID=', $STORE_ID, '">いいえ</a>';
}else if (isset($_GET['DELETE_STORE_ID'])){
   $uid = $_GET['DELETE_STORE_ID'];
   $sql = "DELETE FROM t_rstinfo WHERE STORE_ID='{$uid}'";
   mysql_query($sql, $conn);
   header('Location:pb_home.php?page_id=1');
}else{
  echo '<h2>削除する店舗IDは与えられていません</h2>';
  echo '<a href="?do=pb_home.php?page_id=', $PAGE_ID,'&STORE_ID=', $STORE_ID,'">戻る</a>';
}
?>