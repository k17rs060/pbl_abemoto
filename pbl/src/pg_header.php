<!DOCTYPE html> 
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
<div id="navbar">
<?php
if (isset($_SESSION['urole'])){
  echo $_SESSION['uname'].'&nbsp;&nbsp;';
  $menu = array(   //メニュー項目：プログラム名（拡張子.php省略）
    'HOME'      => 'pb_home',
    'お気に入り'  => 'pb_favor',
  );
  foreach($menu as $label=>$action){ 
    echo  '[<a href="?do=' . $action . '">' . $label . '</a>]&nbsp;' ;
  }
  echo  '[<a href="?do=sys_logout">ログアウト</a>]&nbsp;' ;
  }else{
   echo  '[<a href="?do=sys_login">ログイン</a>]' ;
}
?>
</div>