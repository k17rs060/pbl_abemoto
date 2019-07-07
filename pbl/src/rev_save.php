<?php
header('content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UFT-8">
</head>
<body>
<?php
require_once ('db_inc.php');
//$USER_ID = $_SESSION['$USER_ID'];
$STORE_ID = $_GET ['STORE_ID'];
$STORE_NAME = $_GET ['STORE_NAME'];
if (isset ( $_POST ['act'] )) {
	$act = $_POST ['act'];
	if(isset($REVIEW_ID)){
		$REVIEW_ID = $_POST['REVIEW_ID'];
	}
		$EVALUATION_POINT = $_POST ['EVALUATION_POINT'];
		$COMMENT = $_POST ['COMMENT'];


	if (empty( $_POST ['COMMENT'] )) {


		require_once('rev_registration.php');
		?>
		<br>
		<?php
		echo "<h3>エラー：必須登録の項目に入力が無いため登録できません</h3>";
	} else {


		// アカウントを新規作成する場合のSQL文
		$sql = "INSERT INTO t_review VALUES ('{$REVIEW_ID}','$EVALUATION_POINT','{$COMMENT}')";

		$rs = mysql_query ( $sql, $conn );
		if(!$rs)die('エラー：'.mysql_error());

		header ( 'Location:pb_favorg.php' );

	}
}

?>
</body>
</html>
