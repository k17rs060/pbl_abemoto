<!DOCTYPE html>
<?php
require_once ('db_inc.php');
// 変数の初期化。新規登録か編集かにより異なる。
$act = 'insert'; // 新規登録の場合
$STORE_ID = '';
$STORE_NAME = '';
$ADDRESS = '';
$OP_HOUR = '';
$OP_MIN = '';
$CL_HOUR = '';
$CL_MIN = '';
$MOVE_TIME = '';
$HOLIDAY = '';
$HP_URL = 0;

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
<div id="navbar">

	<h2>
		<input type="reset" value="戻る" onclick="location.href = 'kokosuko.php'">
	</h2>
	<br>

	<h2>店舗登録</h2>
	<form action="str_save.php" method="post">
		<input type="hidden" name="act" value="<?php echo $act; ?>">
		<table>
			<tr>
				<td>店舗ID:</td>
				<td><input type="text" name="$STORE_ID"
					value=<?php echo  uniqid(rand().'_'); ?>></td>
			</tr>
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
						<option value="a">--</option>
						<option value="b">5分未満</option>
						<option value="c">5分～10分</option>
						<option value="d">10分～15分</option>
						<option value="e">15分～20分</option>
						<option value="f">20分～25分</option>
						<option value="g">25分～30分</option>
						<option value="h">30分以上</option>
				</select></td>
			</tr>

			<tr>
				<td>定休日（任意）：</td>
				<td><input type="checkbox" name="HOLIDAY[]" value=d1 />日曜日<input
					type="checkbox" name="HOLIDAY[]" value=d2 />月曜日<input
					type="checkbox" name="HOLIDAY[]" value=d3 />火曜日<input
					type="checkbox" name="HOLIDAY[]" value=d4 />水曜日<input
					type="checkbox" name="HOLIDAY[]" value=d5 />木曜日<input
					type="checkbox" name="HOLIDAY[]" value=d6 />金曜日<input
					type="checkbox" name="HOLIDAY[]" value=d7 />土曜日</td>
			</tr>

			<tr>
				<td>ホームページのURL（任意）：</td>
				<td><input type="text" name="HP_URL" />（半角英数字）</td>
			</tr>


		</table>
		<input type="submit" value="登録">
	</form>
</div>
</div>
</body>
</html>