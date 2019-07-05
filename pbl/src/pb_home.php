<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ココすこ！！</title>
</head>
<body>
<h1>ココすこ！！</h1>
<div align="right">
<form action = "hello.php" method = "post">
 <input type = "submit" value = "店舗登録">　<input type = "submit" value = "ログアウト"><br>
 </form>
</div>
<form action = "hello.php" method = "post">
 <input type = "text" name = "username">　<input type = "submit" value = "検索"><br>
 </form>

<?php
require_once('db_inc.php');
// 一覧データを検索するSQL文
$sql = "SELECT * FROM T_RSTINFO ORDER BY STORE_NAME, ADDRESS, OP_TIME, CLOSE_TIME, MOVE_TIME, HOLIDAY, HP_URL, EVALUATION";
// データベースへ問合せのSQL文($sql)を実行する・・・
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());

// 問合せ結果を表形式で出力する
//echo '<table border=1>';
// まず、ヘッド部分（項目名）を出力
//echo '<tr><th>店舗名</th><th>開始時間～終了時間</th><th>評価</th></tr>';

// 店舗名（STORE_NAME）、営業開始時間（OP_TIME）、営業終了時間（CLOSE_TIME）、評価（EVALUATION）を一覧表示
echo "<br>";
$row = mysql_fetch_array($rs);
while ($row) {
	echo '<tr>';
	echo "店舗名" . "　" . $row['STORE_NAME'] . "　　　" . "評価" . "　" . $row['EVALUATION'] . "点" . "<br>";
	echo "<br>";
	echo "営業時間" . "　" . $row['OP_TIME'] . " 　～　 " . $row['CLOSE_TIME'] . "　　　" . "定休日" . "　" . $row['HOLIDAY']; "<br>";
	echo '</tr>';
	$row = mysql_fetch_array($rs); // 次の行へ
}
echo '</table>'
?>
</body>
</html>
