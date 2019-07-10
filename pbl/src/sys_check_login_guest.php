<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<?php
require_once ('db_inc.php'); // データベースが必要なので読み込ませる
session_start ();
$u = t001;
$sql = "SELECT * FROM t_user WHERE USER_ID= '{$u}'";
$rs = mysql_query ( $sql, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );
$row = mysql_fetch_array ( $rs );
if ($row) { // Login succeeded
	$_SESSION ['USER_ID'] = $row ['USER_ID'];
	$_SESSION ['urole'] = $row ['urole'];
	header('Location:pb_home.php?page_id=1');
} else {
	require_once ('sys_login.php');
	echo 'ユーザ名またはパスワードが間違っています。';
}
?>