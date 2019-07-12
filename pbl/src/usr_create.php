<?php
require_once('db_inc.php');
$roles = array(1=>'学生', 2=>'教員', 9=>'管理者');
// 変数の初期化。新規登録か編集かにより異なる。
$act = 'insert';// 新規登録の場合
$uid = $uname = ''; $urole = 1;
if (isset($_GET['uid'])){//既存アカウントを編集する場合
  $uid = $_GET['uid'] ;
  // 既存アカウントの情報を検索するSQL文
  $sql = "SELECT * FROM tbl_user WHERE uid='{$uid}'";
  // データベースへ問合せのSQL($sql)を実行する・・・
  $rs = mysql_query($sql, $conn);
  if (!$rs) die('エラー: ' . mysql_error());

  //問合せ結果を取得し、それぞれの変数に代入しておく
  $row= mysql_fetch_array($rs);
  if ($row){ // 既存アカウントを編集するために、変数に代入
    $act = 'update';
    $uname = $row['uname'];
    $urole = $row['urole'];
  }
}
?>
<h2>アカウント登録・編集</h2>
<form action="?do=usr_save" method="post">
<input type="hidden" name="act" value="<?php echo $act; ?>">
<table>
<tr><td>ユーザID：</td><td>
<?php
if ($act=='insert'){
  echo '<input type="text" name="uid">';//テキストボックス
}else {
  echo '<input type="hidden" name="uid" value="'.$uid.'">';//非表示送信
  echo "<b>$uid</b>";
}
?>
</td></tr>
<tr><td>氏　名：</td><td>
  <input type="text" name="uname"  value="<?php echo $uname;?>">
</td></tr>
<tr><td>パスワード</td><td>
  <input type="password" name="pass1">
</td></tr>
<tr><td>（再入力）</td><td>
  <input type="password" name="pass2">
</td></tr>
<tr><td>ユーザ種別</td><td>
<?php
  foreach ($roles as $key => $value){
    if ($key==$urole){
      echo '<input type="radio" name="urole" value="' . $key .'" checked>' . $value;
    }else{
      echo '<input type="radio" name="urole" value="' . $key .'">' . $value;
    }
  }
?>
</td></tr>
</table>
<input type="submit" value="登録"><input type="reset" value="取消">
</form>