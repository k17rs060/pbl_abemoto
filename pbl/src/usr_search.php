<h2>ココすこ！！</h2>

<?php

require_once ('db_inc.php');
echo '<tr>';
$LOGIN_ID = $_GET['login_id'];
//if(isset($_POST['search'])){
	$search = isset($_POST['search']);
//}else{
//	$search =0;
//}
echo '<td align="center"><button><a href="pb_home.php?page_id=1&login_id='.$LOGIN_ID.'">戻る</a></button></td>';

// ///////////// 店舗情報をデータベースから呼び出す ///////////////
if($search !=isset($_POST['search'])){
$cnt = "SELECT COUNT(*) as cnt FROM t_rstinfo WHERE STORE_ID";
}else{
	$cnt = "SELECT COUNT(*) as cnt FROM t_rstinfo LIKE '%$search%'";
}
$rs = mysql_query ( $cnt, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );
$ecnt = mysql_fetch_array ( $rs );

if ($ecnt) {
	$cnt = $ecnt ['cnt'];
}

$AVG = "SELECT AVG(EVALUATION_POINTS) as avg FROM t_review WHERE STORE_ID";
$rs1 = mysql_query ( $AVG, $conn );
if (! $rs1)
	die ( 'エラー: ' . mysql_error () );
$avg = mysql_fetch_array ( $rs1 );
if ($avg) {
	$evaluation = $avg ['avg'];
}
//$EVALUTION=  floor ( $evaluation * pow ( 10, 1 ) ) / pow ( 10, 1 );
$max = "SELECT * FROM t_rstinfo WHERE STORE_NAME LIKE '%$search%'";
$rs2 = mysql_query ( $max, $conn );

if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

$row = mysql_fetch_array ( $rs2 );
if ($row) {
	$store_id = $row ['STORE_ID'];
	$store_name = $row ['STORE_NAME'];
	$address = $row ['ADDRESS'];
	$op_hour = $row ['OP_HOUR'];
	$op_min = $row ['OP_MIN'];
	$cl_hour = $row ['CL_HOUR'];
	$cl_min = $row ['CL_MIN'];
	$hp_url = $row ['HP_URL'];
	$user_id = $row ['USER_ID'];
	$EVALUATION =$row['EVALUATION'];
}

while ( $row ) {
	echo '<tr>' . '<h3>';
	echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . '<a href="/pbl/src/pb_favorg.php?page_id=1&STORE_ID=' . $row['STORE_ID'] .'&USER_ID=' . $row['USER_ID'] .'&login_id=' . $LOGIN_ID. '">' . $row['STORE_NAME'] . '</a>' . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . "評価" . floor ( $row['EVALUATION'] * pow ( 10, 1 ) ) / pow ( 10, 1 ) . "点" . '</td>';
	echo '<br>';
	$holiday = array (
			0 => 'なし',
			1 => '日曜日',
			2 => '月曜日',
			3 => '火曜日',
			4 => '水曜日',
			5 => '木曜日',
			6 => '金曜日',
			7 => '土曜日'
	);
	$i = $row ['HOLIDAY'];
	if ($op_hour == -1 || $op_min == -1 || $cl_hour == -1 || $cl_min == -1) {
		echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . "--" . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $holiday [$i] . '</td>';
	} else {
		echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . $op_hour . "：" . $op_min . "～" . $cl_hour . "：" . $cl_min . '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $holiday [$i] . '</td>';
	}
	echo '<br>';

	echo '</h3>' . '</tr>';
	echo '<hr>';

	$row = mysql_fetch_array ( $rs2); // 次の行へ
}

?>
