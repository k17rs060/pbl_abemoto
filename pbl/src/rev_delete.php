<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<?php
require_once('db_inc.php');
session_start ();
$USER_ID = $_SESSION['USER_ID'];
$PAGE_ID = $_GET['page_id'];
$STORE_ID = $_GET['STORE_ID'];//http://localhost/pbl/src/rev_delete.php?USER_ID=u001?page_id=1&STORE_ID=17436_5d22e4be0c
$STORE_NAME = $_GET['STORE_NAME'];
//$REVIEW_ID = $_GET['REVIEW_ID'];
if (isset($_GET['REVIEW_ID'])){
  $REVIEW_ID = $_GET['REVIEW_ID'];
  $STORE_NAME = $_GET['STORE_NAME'];
  echo '<h2>'. $STORE_NAME . 'に登録してある口コミ情報を削除しますか?</h2>';
  echo '<a href="rev_delete.php?DELETE_REVIEW_ID='.$REVIEW_ID.'&USER_ID='. $USER_ID . '&page_id='. $PAGE_ID.'&STORE_ID='.$STORE_ID.'&STORE_NAME='.$STORE_NAME.'">はい</a>
  		| <a href=pb_favorg.php?page_id='. $PAGE_ID.'&STORE_ID='.$STORE_ID.'>いいえ</a>';
}else if (isset($_GET['DELETE_REVIEW_ID'])){
   $REVIEW_ID = $_GET['DELETE_REVIEW_ID'];
   $sql = "DELETE FROM t_review WHERE REVIEW_ID='{$REVIEW_ID}'";
   mysql_query($sql, $conn);
   header('Location:pb_favorg.php?page_id='. $PAGE_ID.'&STORE_ID='.$STORE_ID.'');
}else{
  echo '<h2>削除する口コミIDは与えられていません</h2>';
  echo '<a href="?do=pb_favorg?page_id='. $PAGE_ID,'&SOTRE_ID='.$STORE_ID.'">戻る</a>';
}
?>