<!DOCTYPE html>
<?php
require_once('db_inc.php');
session_start ();
$USER_ID = $_SESSION['USER_ID'];
$STORE_ID =  $_GET['STORE_ID'];
$STORE_NAME = $_GET ['STORE_NAME'];

$act = 'insert';
$REVIEW_ID = '';
$EVALUATION_POINT = 0;
$COMMENT = '';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UFT-8">
</head>
<body>
<form action="rev_save.php" method="post">
<h2>
<?php
// $sql = "SELECT * FROM T_RSTINFO WHERE STORE_ID='{$STORE_ID}'";

echo "<h4>$STORE_NAME</h4>";
		echo "<h4>への口コミ</h4>";
?>
</h2>
<h3>口コミ登録</h3>
<input type = "hidden" name = "act" value = "<?php echo $act; ?>">
<input type = "hidden" name = "USER_ID" value = "<?php echo $USER_ID; ?>">
<input type = "hidden" name = "STORE_ID" value = "<?php echo $STORE_ID; ?>">
<table><tr>

<td><input type="hidden" name="REVIEW_ID" value="<?php echo uniqid(rand().'_');?>">

</td></tr>
<tr><td>評価点</td></tr><tr><td>
 <input type="radio" name="EVALUATION_POINT" value="1"/>1
 <input type="radio" name="EVALUATION_POINT" value="2"/>2
 <input type="radio" name="EVALUATION_POINT" value="3" checked/>3
 <input type="radio" name="EVALUATION_POINT" value="4"/>4
 <input type="radio" name="EVALUATION_POINT" value="5"/>5
</td></tr>

<tr><td>コメント</td></tr><tr><td>
<textarea name="COMMENT" rows="10" cols="40"></textarea>
</td></tr>



</table>
<input type = "submit" value = "登録">
</form>
</body>
</html>
