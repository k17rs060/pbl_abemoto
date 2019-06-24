<?php 
  $conn = mysql_connect("localhost","root","");//MySQLサーバへ接続
  mysql_select_db("pbl2019", $conn);    // 使用するデータベースを指定
  mysql_query('set names utf8', $conn); //文字コードをutf8に設定（文字化け対策）
?>