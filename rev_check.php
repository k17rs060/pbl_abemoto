<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
</head>
<body>
<?php
$e = $_POST['EVALUATION_POINTS'];
$c = $_POST['COMMENT'];
$sql = "SELECT*FROM tbl_user WHERE uid='{$u}'AND upass='{$p}'";
$conn = mysql_connect("localhost","root","");

mysql_select_db("pbl2019",$conn);
mysql_query('set names utf8',$coon);

$rs = mysql_query($sql,$conn);
if(!$rs)die('エラー:'.mysql_error());
$row = mysql_fetch_array($rs);
if($row){
 echo '<a href="">戻る</a>';
}else{
	echo'<h2>「コメント」が未入力です</h2>';
	;
}
?>
</body></html>
