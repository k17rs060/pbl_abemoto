<?php
require_once('db_inc.php');
if (isset($_POST['act'])){
  $act = $_POST['act'];
  if ($_POST['pass1']===$_POST['pass2']){
    $e = $_POST['EVALUATION_POINT'];
    $c = $_POST['COMMENT'];

    //アカウントを新規作成する場合のSQL文
    $sql ="INSERT INTO tbl_user VALUES ('{$e},$c)";
    if ($act=='update'){
      //既存のアカウントを編集する場合のSQL文
      $sql = "UPDATE tbl_user SET EVALUATION_POINT='{$e}',COMMENT='{$c}'";
    }
  }
}
 ?>