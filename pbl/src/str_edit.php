<!DOCTYPE html>
<?php
require_once ('db_inc.php');
$store_id = $_GET['STORE_ID'];
// 変数の初期化。新規登録か編集かにより異なる。
$act = 'update'; // 編集の場合
$STORE_ID = $store_id;
$STORE_NAME = '';
$ADDRESS = '';
$OP_HOUR = 0;
$OP_MIN = 0;
$CL_HOUR = 0;
$CL_MIN = 0;
$MOVE_TIME = 0;
$HOLIDAY = 0;
$HP_URL = '';
$sql = "SELECT * FROM t_rstinfo WHERE STORE_ID='{$STORE_ID}'";
// データベースへ問合せのSQL($sql)を実行する・・・
$rs = mysql_query ( $sql, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );
// 問合せ結果を取得し、変数に代入
$row = mysql_fetch_array ( $rs );
if ($row) { // 既存アカウントを編集するために、問合せ結果を$pid,$reasonに代入
	$STORE_NAME = $row['STORE_NAME'];
	$ADDRESS = $row['ADDRESS'];
	$OP_HOUR = $row['OP_HOUR'];
	$OP_MIN = $row['OP_MIN'];
	$CL_HOUR = $row['CL_HOUR'];
	$CL_MIN = $row['CL_MIN'];
	$MOVE_TIME = $row['MOVE_TIME'];
	$HOLIDAY = $row['HOLIDAY'];
	$HP_URL = $row['HP_URL'];
}
?>



<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div class="wrapper">
<div id="navbar">
<?php
	echo '<td align="center"><button><a href=\'/pbl/src/pb_favorg.php?page_id=1&STORE_ID=', $store_id, '\'>' .
     "戻る" . '</a></button></td>';
echo '</tr>';
?>
	<br>


	<h2>店舗編集</h2>
	<form action="str_editsave.php" method="post">
		<input type="hidden" name="act" value="<?php echo $act; ?>">
		<table>
		<?php
		echo 	'<tr>';

		echo		'<td><input type="text" name="$STORE_ID" value="'.$store_id.'">
					</td>';

		echo 	'</tr>';
			?>
			<tr>
				<td>店舗名（必須）：</td>
				<td><input type="text" name="STORE_NAME"
					value="<?php echo $STORE_NAME;?>">（全角）</td>
			</tr>


			<tr>
				<td>住所（必須）：</td>
				<td><input type="text" name="ADDRESS">（全角）</td>
			</tr>


			<tr>
				<td>営業時間（任意）：</td>
				<td>
<?php
echo '<select name="OP_HOUR">';
for($a = - 1; $a <= 23; $a ++) {
	if ($a == - 1) {
		echo '<option value = "' . $a . '"> --';
	} else {
		echo '<option value = "' . $a . '">' . $a . ' ';
	}
}
echo '</select>';
?> :  <?php
echo '<select name="OP_MIN">';

for($b = - 1; $b <= 5; $b ++) {
	if ($b == - 1) {
		echo '<option value = "' . $b . '"> --';
	} else if ($b == 0) {
		echo '<option value = "' . $b . '">00';
	} else {
		echo '<option value = "' . $b . '">' . $b * 10.;
	}
}
echo '</select>';
?> ～ <?php
echo '<select name="CL_HOUR">';
for($c = - 1; $c <= 23; $c ++) {
	if ($c == - 1) {
		echo '<option value = "' . $c . '"> --';
	} else {
		echo '<option value = "' . $c . '">' . $c . ' ';
	}
}
echo '</select>';
?> : <?php
echo '<select name="CL_MIN">';
for($d = - 1; $d <= 5; $d ++) {
	if ($d == - 1) {
		echo '<option value = "' . $d . '"> --';
	} else if ($d == 0) {
		echo '<option value = "' . $d . '">00';
	} else {
		echo '<option value = "' . $d . '">' . $d * 10.;
	}
}
echo '</select>';
?>
</td>
			</tr>


			<tr>
				<td>移動時間（任意）：</td>
				<td><select name="MOVE_TIME">
						<option value="0">--</option>
						<option value="1">5分未満</option>
						<option value="2">5分～10分</option>
						<option value="3">10分～15分</option>
						<option value="4">15分～20分</option>
						<option value="5">20分～25分</option>
						<option value="6">25分～30分</option>
						<option value="7">30分以上</option>
				</select></td>
			</tr>


			<tr>
				<td>定休日（任意）：</td>
				<td><input type="hidden" name="HOLIDAY[]" value=0 />
					<input type="checkbox" name="HOLIDAY[]" value=1 />日曜日<input
					type="checkbox" name="HOLIDAY[]" value=2 />月曜日<input
					type="checkbox" name="HOLIDAY[]" value=3 />火曜日<input
					type="checkbox" name="HOLIDAY[]" value=4 />水曜日<input
					type="checkbox" name="HOLIDAY[]" value=5 />木曜日<input
					type="checkbox" name="HOLIDAY[]" value=6 />金曜日<input
					type="checkbox" name="HOLIDAY[]" value=7 />土曜日
				</td>
			</tr>


			<tr>
				<td>ホームページのURL（任意）：</td>
				<td><input type="text" name="HP_URL" />（半角英数字）</td>
			</tr>




		</table>
		<input type="submit" value="更新">
	</form>
</div>
</div>
</body>
</html>