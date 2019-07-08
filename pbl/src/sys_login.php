<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<h2>ココすこ！！</h2>
<div style="display:inline-flex">
<h1>ログイン</h1>&nbsp;&nbsp;
</div>
<?php
echo '<td align="center"><button><a href="pb_home.php?page_id=1&login_id=t001">ゲストはこちら</a></button></td>';
?>
<form action="sys_check_login.php" method="post">
<table>
<tr><td>ユーザID：</td><td><input type="text" name="USER_ID"></td></tr>
<tr><td>パスワード：</td><td><input type="password" name="USER_PASS"></td></tr>
<tr><td></td><td>
  <input type="submit" value="送信">
</td></tr>
</table>
</form>