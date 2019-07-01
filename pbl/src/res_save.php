<?php
require_once('db_inc.php');
if (isset($_POST['act'])){
  $act = $_POST['act'];
  if (isset($_POST['STORE_NAME']) && isset($_POST['ADDRESS'])) {
    $STORE_INFO = $_POST['STORE_NAME'];
    $STORE_NAME = $_POST['STORE_NAME'];
    $ADDRESS = $_POST['ADDRESS'];
    $op_hour = $_POST['op_hour'];
    $op_min = $_POST['op_min'];
    $cl_hour = $_POST['cl_hour'];
    $cl_min = $_POST['cl_min'];
    $MOVE_TIME = $_POST['MOVE_TIME'];
    $HOLIDAY = $_POST['HOLIDAY'];
    $HP_URL = $_POST['HP_URL'];

    //アカウントを新規作成する場合のSQL文
    $sql ="INSERT INTO T_RSTINFO VALUES
    ('{$STORE_INFO}','{$STORE_NAME}','{$ADDRESS}','{$op_hour}','{$op_min}',
    '{$cl_hour}','{$cl_min}','{$MOVE_TIME}','{$HOLIDAY}','{$HP_URL}')";

    header('Location:pb_home.php');

    }else{
    	header('Location:res_miss_create_1.php');
    }

    function isZenkaku($String){
    	if($string === mb_convert_kana($string, 'ASKH', 'UTF-8')){
    		echo '<h3>エラー：全角文字以外の文字が入力されているため登録できません</h3>';
    	}
    	return $string === mb_convert_kana($string, 'ASKH', 'UTF-8');
    }

    if ($act=='update'){
      //既存のアカウントを編集する場合のSQL文
      $sql = "UPDATE T_RSTINFO SET STORE_NAME='{$STORE_NAME}',ADDRES='{$ADDRESS}',
      op_hour='{$op_hour}',op_min='{$op_min}',cl_hour={$cl_hour},cl_min={$c_min},
      MOVE_TIME='{$MOVE_TIME}',HOLIDAY='{$HOLIDAY}',HP_URL='{$HP_URL}',
      WHERE STORE_INFO='{$STORE_INFO}'";
    }
    mysql_query($sql, $conn);
    echo '<h3>店舗情報が更新されました</h3>';
  }else{
    echo '<h3>エラー：必須登録の項目に入力が無いため登録できません</h3>';
  }

?>