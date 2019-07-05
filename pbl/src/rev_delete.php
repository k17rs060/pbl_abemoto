<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<?php
require_once('db_inc.php');
if (isset($_GET['REVIEW_ID'])){
  $REVIEW_ID = $_GET['REVIEW_ID'];
  $STORE_NAME = $_GET['STORE_NAME'];
  echo '<h2>'. $STORE_NAME . 'に登録してある口コミ情報を削除しますか?</h2>';
  echo '<a href="rev_delete.php?&uuid='. $REVIEW_ID . '">はい</a> | <a href=pb_favorg.php>いいえ</a>';
}else if (isset($_GET['uuid'])){
   $REVIEW_ID = $_GET['uuid'];
   $sql = "DELETE FROM t_review WHERE REVIEW_ID='{$REVIEW_ID}'";
   mysql_query($sql, $conn);
   header('Location:pb_favorg.php');
}else{
  echo '<h2>削除する口コミIDは与えられていません</h2>';
  echo '<a href="?do=pb_favorg">戻る</a>';
}
?>