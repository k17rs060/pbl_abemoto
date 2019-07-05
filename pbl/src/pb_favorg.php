<h2>ココすこ！！</h2>
<?php
require_once ('db_inc.php');
// ///////////// ログインユーザーの確認 ///////////////
// $uid = $_SESSION['USER_ID'];
// $sid = strtoupper($uid);
// $utid = $_SESSION['USER_TYPE_ID'];
// $stid = strtoupper($utid);

// ///////////// ホーム画面から店舗のデータを受け取る ///////////////
// $store_id = $POST ['STORE_ID'];
// $store_id = 'STORE_INFO';

// ///////////// 仮の情報 ///////////////
$urole = 1;
$ruser_id = 'u001';
$store_id = "r001";

// ///////////// 店舗情報をデータベースから呼び出す ///////////////
$sql = "SELECT * FROM t_rstinfo WHERE STORE_ID = '$store_id'";
$rs = mysql_query ( $sql, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );

$AVG = "SELECT AVG(EVALUATION_POINTS) as avg FROM t_review WHERE STORE_ID='$store_id'";
$rs2 = mysql_query ( $AVG, $conn );
if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

// ///////////// 問合せ結果を取得し、それぞれの変数に代入しておく ///////////////
$row = mysql_fetch_array ( $rs );
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

	if ($op_hour == NULL)
		$op_hour = 99;
	if ($op_min == NULL)
		$op_min = 99;
	if ($cl_hour == NULL)
		$cl_hour = 99;
	if ($cl_min == NULL)
		$cl_min = 99;
}

$avg = mysql_fetch_array ( $rs2 );
if ($avg) {
	$evaluation = $avg ['avg'];
}

// ///////////// ボタン表示 ///////////////
echo '<tr>';

echo '<td align="center"><button><a href="pb_home.php">戻る</a></button></td>';

if ($user_id == $ruser_id) {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
	      <a href="usr_create.php">店舗編集</a></button></td>';

	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
		<a href="str_delete.php?&STORE_ID=' . $store_id . '&STORE_NAME=' . $store_name . '">店舗削除</a></button></td>';
}

if ($urole == 1) {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' .'&nbsp;' . '<button><a href="sys_logout.php">ログアウト</a>
		 </button></td>';

} else {

	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button><a href="sys_logout.php">ログオフ</a>
		 </button></td>';
}
echo '</tr>';
echo '<br>';

// ///////////// 店舗情報 ///////////////
echo '<tr>' . '<h3>';
echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . $store_name . '</td>';
echo '<td>' . '&nbsp;' . '&nbsp;' . "評価" . floor ( $evaluation * pow ( 10, 1 ) ) / pow ( 10, 1 ) . "点" . '</td>';
echo '<br>';
echo '<td>' . "住所" . '&nbsp;' . '&nbsp;' . $address . '</td>'; // 住所
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
if ($op_hour == 99 || $op_min == 99 || $cl_hour == 99 || $cl_min == 99) {
	echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . "--" . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' .
	      "定休日" . '&nbsp;' . '&nbsp;' . $holiday [$i] . '</td>';
} else {
	echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . $op_hour . "：" . $op_min . "～" . $cl_hour . "：" . $cl_min .
	     '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $holiday [$i] . '</td>';
}
echo '<br>';

$move_time = array (
		0 => '--',
		1 => '5分未満',
		2 => '5分～10分',
		3 => '10分～15分',
		4 => '15分～20分',
		5 => '20分～25分',
		6 => '25分～30分',
		7 => '30分以上'
);
$j = $row ['MOVE_TIME'];
echo '<td>' . "移動時間" . '&nbsp;' . '&nbsp;' . $move_time [$j] . '</td>';
echo '<br>';

if ($hp_url == NULL) {
	echo '<td>' . "ホームページのURL" . '&nbsp;' . '&nbsp;' . '--' . '</td>';
} else {
	echo '<td>' . "ホームページのURL" . '&nbsp;' . '&nbsp;' . '<a href="eps_list.php">' . $hp_url . '</a>' . '</td>';
}
echo '<br>';

if ($urole == 1) {
	echo '<td align="center"><button><a href="eps_list.php">口コミ登録</a></button></td>';
}
echo '</h3>' . '</tr>';
echo '<hr>';

// ///////////// 口コミをデータベースから呼び出す ///////////////
$cnt = "SELECT COUNT(*) as cnt FROM t_review WHERE STORE_ID='$store_id'";

$rs3 = mysql_query ( $cnt, $conn );
if (! $rs3)
	die ( 'エラー: ' . mysql_error () );
$ecnt = mysql_fetch_array ( $rs3 );
if ($ecnt) {
	$cnt = $ecnt ['cnt'];
}
$max_page = ceil ( $cnt / 10 );
if ($_GET ['page_id'] == 1) {
	$max = "SELECT * FROM t_review WHERE STORE_ID ='$store_id'LIMIT 10  ";
} else {
	for($i = 1; $i <= $_GET ['page_id']; $i ++) {
		$max = "SELECT * FROM t_review WHERE STORE_ID ='$store_id  'LIMIT 10 OFFSET " . $i;
	}
}

$rs = mysql_query ( $max, $conn );

if (! $rs)
	die ( 'エラー: ' . mysql_error () );

$row = mysql_fetch_array ( $rs );
if ($row) {
	$review_id = $row ['REVIEW_ID'];
	$evaluation_points = $row ['EVALUATION_POINTS'];
	$comment = $row ['COMMENT'];
	$cuser_id = $row ['USER_ID'];
	$store_id = $row ['STORE_ID'];
	if (! $review_id)
		$review_id = $row ["NULL"];
	if (! $evaluation_points)
		$evaluation_points = $row [0];
	if (! $comment)
		$comment = $row ["NULL"];
	if (! $ruser_id)
		$cuser_id = $row ["NULL"];
	if (! $store_id)
		$store_id = "NULL";
}

if (! isset ( $_GET ['page_id'] )) {
	$now = 1;
} else {
	$now = $_GET ['page_id'];
}

while ( $row ) {
	echo '<tr>';
	echo '<td>' . $row ['REVIEW_ID'] . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "評価" . $row ['EVALUATION_POINTS'] . "点" . '</td>';
	if ($row ['USER_ID'] == $ruser_id) {
		echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>' .
		     '<a href="res_delete.php?&REVIEW_ID=' . $review_id . '&STORE_NAME=' . $store_name . '">' .
		     "口コミ削除" . '</a>' . '</button>' . '</td>';
	}
	echo '<br>';

	$limit = 29;
	if (mb_strlen ( $row ['COMMENT'] ) >= $limit) {
		$title = mb_strimwidth ( ($row ['COMMENT']), 0, $limit, "...", "UTF-8" );

		echo '<td>' . $title . '</td>';
		echo '<td>' . '<a href="eps_list.php">' . "もっと見る" . '</a>' . '</td>';
	} else {
		echo '<td>' . $row ['COMMENT'] . '</td>';
	}

	echo '<br>';
	echo '</td>';
	echo '</tr>';
	echo '<hr>';
	$row = mysql_fetch_array ( $rs ); // 次の行へ
}

// ///////////// ページの処理 ///////////////
for($i = 1; $i <= $max_page; $i ++) {
	if ($i == $now) {
		echo $now . ' ';
	} else if ($i == 1) {
		echo '<a href=\'/pbl/src/pb_favorg.php?page_id=', $i, '\'>' . $i . '</a>', ' ';
	} else {
		echo '<a href=\'/pbl/src/pb_favorg.php?page_id=', (($i * 10) - 10), '\'>' . $i . '</a>', ' ';
	}
}

?>
