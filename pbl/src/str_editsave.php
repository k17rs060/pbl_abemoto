<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
<div id="navbar">
<?php
require_once ('db_inc.php');
session_start ();
$USER_ID = $_SESSION ['USER_ID'];
if (isset ( $_POST ['act'] )) {
	$act = $_POST ['act'];
	$STORE_ID = $_POST ['$STORE_ID'];
	$STORE_NAME = $_POST ['STORE_NAME'];
	$ADDRESS = $_POST ['ADDRESS'];
	$OP_HOUR = $_POST ['OP_HOUR'];
	$OP_MIN = $_POST ['OP_MIN'];
	$CL_HOUR = $_POST ['CL_HOUR'];
	$CL_MIN = $_POST ['CL_MIN'];
	$MOVE_TIME = $_POST ['MOVE_TIME'];

	if (isset($_POST['HOLIDAY']) && is_array($_POST['HOLIDAY'])) {
		$HOLIDAY = $_POST['HOLIDAY'];
	}
	$HP_URL = $_POST ['HP_URL'];
	$error_1 = '';
	$error_2 = '';
	$error_3 = '';
	$error_4 = '';
	$error_5 = '';
	mb_regex_encoding("UTF-8");
	if (empty ( $_POST ['STORE_NAME'] ) || empty ( $_POST ['ADDRESS'] )) {
		$error_1 = 'エラー：登録が必須の項目に入力が行われていません';
	}
	if (!preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$STORE_NAME) && $STORE_NAME != "") {
		$error_2 = 'エラー：店舗名の入力に半角文字が含まれています';
	}
	if (!preg_match("/^[ぁ-んァ-ヶー一-龠]+$/u",$ADDRESS) && $ADDRESS != "") {
		$error_3 = 'エラー：住所の入力に半角文字が含まれています';
	}
	if(($OP_HOUR != -1 && $OP_MIN == -1) || ($OP_HOUR == -1 && $OP_MIN != -1) ||
			($CL_HOUR != -1 && $CL_MIN == -1) || ($CL_HOUR == -1 && $CL_MIN != -1)){
		$error_4 ='エラー：営業時間を入力する際は「--」が無いように入力してください';
	}
	if (!preg_match ( "/^[a-zA-Z0-9]+$/", $HP_URL ) && $HP_URL != ""){
		 $error_5 = 'エラー：URLの入力に半角英数字以外の文字が含まれています';
	}
	if($error_1 != '' || $error_2 != '' || $error_3 != '' || $error_4 != ''){
		require_once('str_create.php');
		echo "$error_1<br />";
		echo "$error_2<br />";
		echo "$error_3<br />";
		echo "$error_4<br />";
		echo "$error_5<br />";
	}
		//	$sql = "UPDATE t_rstinfo SET STORE_ID= '{$STORE_ID}',STORE_NAME='{$STORE_NAME}',ADDRESS='{$ADDRESS}',
		//	OP_HOUR='{$OP_HOUR}',OP_MIN='{$OP_MIN}',CL_HOUR={$CL_HOUR},CL_MIN={$CL_MIN},
		//	MOVE_TIME='{$MOVE_TIME}',HOLIDAY='{$HOLIDAY}',HP_URL='{$HP_URL}',
		//   USER_ID='{$USER_ID}'
		//	WHERE STORE_ID='{$STORE_ID}'";
			foreach ($HOLIDAY as $val){
				$holiday="UPDATE  t_rstinfo SET STORE_ID= '{$STORE_ID}',STORE_NAME='{$STORE_NAME}',ADDRESS='{$ADDRESS}',
			OP_HOUR='{$OP_HOUR}',OP_MIN='{$OP_MIN}',CL_HOUR={$CL_HOUR},CL_MIN={$CL_MIN},
			MOVE_TIME='{$MOVE_TIME}',HOLIDAY='$val',HP_URL='{$HP_URL}',
		    USER_ID='{$USER_ID}'
			WHERE STORE_ID='{$STORE_ID}'";
			}
		// データベースへ問合せのSQL($sql)を実行する・・・
		$rs = mysql_query($holiday, $conn);
		if (!$rs) die('エラー: ' . mysql_error());
		header('Location:pb_favorg.php?page_id=1&STORE_ID='. $STORE_ID.'');
}
?>
</div>
</div>
</body>
</html>