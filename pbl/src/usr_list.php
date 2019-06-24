<?php
require_once('db_inc.php');
echo "<h2>アカウント一覧</h2>";
$where = '1';
include('usr_search.php');

// 一覧するデータを検索するSQL
//$sql = "SELECT * FROM tbl_user ORDER BY urole, uid";
$sql = "SELECT * FROM tbl_user WHERE $where ORDER BY urole, uid";
//データベースへの問合せ($sql)を実行する・・・
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
// 問合せ結果を表形式で出力する。

echo '<table border=1>';
// まず、ヘッド部分（項目名）を出力
echo '<tr><th>No.</th><th>氏名</th><th>ユーザ種別</th></tr>';

// ユーザID（uid）、ユーザ名(uname)、ユーザ種別(urole)を一覧表示
$row = mysql_fetch_array($rs) ;
while ($row) {
  echo '<tr>';
  echo '<td>' . $row['uid'] . '</td>';
  echo '<td>' . $row['uname']. '</td>';
 // echo '<td>' . $row['urole']. '</td>';
 $roles = array(
    1=>'学生', 
    2=>'教員', 
    9=>'管理者'
 );
 $i  = $row['urole'];     // 数字のユーザ種別をで取得
 echo '<td>' . $roles[$i] . '</td>'; // ユーザ種別名を出力
 /*$uid = $row['uid'];
 echo '<td><a href="?do=usr_create&uid='.$uid.'">編集</a></td>'; 
 echo '<td><a href="?do=usr_delete&uid='.$uid.'">削除</a></td>'; 
 */
 echo '</tr>';
 $row = mysql_fetch_array($rs);//次の行へ
}
echo '</table>';
?>