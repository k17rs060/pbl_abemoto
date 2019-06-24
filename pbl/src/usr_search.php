<?php
$urole = 0;
if (isset($_POST['urole'])){
  $urole = $_POST['urole'];
}
$uroles = array(
    0=>'全員',
    1=>'学生', 
    2=>'教員', 
    9=>'管理者'
 );
echo '<form action="?do=usr_list" method="post">';
foreach ($uroles as $role=>$name){
  $checked = ($role==$urole)?' checked' : '';
  echo "<input type=\"radio\" name=\"urole\" value=\"$role\" $checked>" . $name;
}
echo '<input type="submit" value="検索">';
echo '</form>';
if ($urole > 0){
  $where .=" AND urole=$urole";
}
?>