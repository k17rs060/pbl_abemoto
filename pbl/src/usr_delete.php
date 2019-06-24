<?php
require_once('db_inc.php');
if (isset($_GET['uid'])){
  $uid = $_GET['uid'];
  echo '<h2>'. $uid . 'を本当に削除しますか?</h2>';
  echo '<a href="?do=usr_delete&uuid='. $uid . '">削除</a> | <a href="?do=usr_list">戻る</a>';
}else if (isset($_GET['uuid'])){
   $uid = $_GET['uuid'];
   $sql = "DELETE FROM tbl_user WHERE uid='{$uid}'";
   mysql_query($sql, $conn);
   header('Location:?do=usr_list');
}else{
  echo '<h2>削除するユーザIDは与えられていません</h2>';
  echo '<a href="?do=usr_list">戻る</a>';
}
?>