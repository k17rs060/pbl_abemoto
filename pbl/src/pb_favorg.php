<h2>ココすこ！！</h2>
<?php
require_once ('db_inc.php');
// $uid = $_SESSION['USER_ID'];
// $sid = strtoupper($uid);
// $utid = $_SESSION['USER_TYPE_ID'];
// $stid = strtoupper($utid);
// 店舗情報
// $store_info = $POST ['STORE_INFO'];
// $SELECT s.* FROM t_user s WHERE s. USER_ID='{$user_id}'
// UNIONsql = "SELECT * FROM t_restinfo WHERE STORE_INFO='{$store_info}'";
// $rs = mysql_query ( $sql, $conn );
// if (! $rs)
// die ( 'エラー: ' . mysql_error () );

// 問合せ結果を取得し、それぞれの変数に代入しておく
// $row = mysql_fetch_array ( $rs );
// if ($row) {
// $store_name = $row ['STORE_NAME'];
// $address = $row ['ADDRESS'];
// $op_time = $row ['OP_TIME'];
// $close_time = $row ['CLOSE_TIME'];
// $store_info = $row ['STORE_INFO'];
// $move_time = $row ['MOVE_TIME'];
// $holiday = $row ['HOLIDAY'];
// $hp_url = $row ['HP_URL'];
// $evaluation = $row ['EVALUATION'];
// $suser_id= $row['USER_ID']
// if(!$store_info) $store_info = "";
// if(!$store_name) $store_name = "";
// if(!$address) $address = "";
// if(!$op_time) $op_time = 0;
// if(!$close_time) $close_time = 0;
// if(!$move_time) $move_time = 0;
// if(!$holiday) $holiday = "";
// if(!$hp_url) $hp_url = "";
// if(!$evaluation) $evaluation = 0;
// if(!$suser_id) $user_id = "";
// }

$store_info = "ファミレス";
$store_name = "ファミレス";
$address = "福岡";
$op_time = 12;
$close_time = 20;
$move_time = 5;
$holiday = "火曜日";
$hp_url = "https";
$evaluation = 3;
$suser_id = "u001";
$urole = 1;
$user_id = 'u001';
echo '<tr>';
echo '<td align="center">' . '<button>' . '<a href="pb_home.php">' . "戻る" . '</a>' . '</button>' . '</td>';
if ($suser_id == $user_id) {
	// if ($suser_id == "u001") {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>' . '<a href="usr_create.php">' . "店舗編集" . '</a>' . '</button></td>';
}
if ($suser_id == $user_id) {
	// if ($suser_id == "u001") {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
<a href="usr_delete.php">店舗削除</a>
</button></td>';
}
if ($urole == 1) {
	// if ($user_id == "u001") {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
<a href="sys_logout.php">ログアウト</a>
</button></td>';
} else {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
<a href="sys_logout.php">ログオフ</a>
</button></td>';
}
echo '</tr>';
echo '<br>';
// 店舗情報
echo '<tr>' . '<h3>';
echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . $store_name . '</td>'; // 店舗名
echo '<td>' . '&nbsp;' . '&nbsp;' . "評価" . $evaluation . "点" . '</td>';
echo '<br>';
echo '<td>' . "住所" . '&nbsp;' . '&nbsp;' . $address . '</td>'; // 住所
echo '<br>';
echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . $op_time . "～" . $close_time . '</td>'; // 営業時間
echo '<br>';
echo '<td>' . "移動時間" . '&nbsp;' . '&nbsp;' . $move_time . '</td>'; // 移動時間
echo '<br>';
echo '<td>' . "ホームページのURL" . '&nbsp;' . '&nbsp;' . $hp_url . '</td>'; // ホームページのURL
echo '<br>';
if ($urole == 1) {
	// if (suser_id == 'u001') {
	echo '<td align="center"><button>
		<a href="eps_list.php">口コミ登録</a>
	</button></td>';
}
echo '</h3>' . '</tr>';
?>
<hr>


<?php
// 口コミ情報
// $_SESSION['STORE_ID'];
define ( 'MAX', '5' );
$max = "SELECT * FROM t_review ORDER BY REVIEW_ID limit 5";
$rs = mysql_query ( $max, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );
$row = mysql_fetch_array ( $rs );
if ($row) {
	$review_id = $row ['REVIEW_ID'];
	$evaluation_points = $row ['EVALUATION_POINTS'];
	$comment = $row ['COMMENT'];
	$ruser_id = $row ['USER_ID'];
	$store_id = $row ['STORE_ID'];
	// if(!$review_id) $review_id = "エラー";
	// if(!$evaluation_points) $evaluation_points = "エラー";
	// if(!$comment) $comment = "エラー";
	// if(!$ruser_id) $ruser_id = "エラー";
	// if(!$store_id) $store_id = "エラー";
}

$max_num = count ( $row );
$max_page = ceil ( $max_num / MAX );
if (! isset ( $_GET ['page_id'] )) {
	$now = 1;
} else {
	$now = $_GET ['page_id'];
}

$start_no = ($now - 1) * MAX;
$disp_data = array_slice ( $row, $start_no, MAX, true );
// foreach ( $disp_data as $row ){
while ( $row ) {
	// if ($store_id == $store_info) {
	// if ($store_id == "ファミレス") {
	echo '<tr>';
	echo '<td>' . $row ['REVIEW_ID'] . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "評価" . $row ['EVALUATION_POINTS'] . "点" . '</td>';
	if ($row ['REVIEW_ID'] == $suser_id) {
		echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>' . '<a href="usr_delete.php">' . "口コミ削除" . '</a>' . '</button>' . '</td>';
	}
	echo '<br>';
	$limit = 30;
	if (mb_strlen ( $row ['COMMENT'] ) > $limit) {
		$title = mb_strimwidth ( ($row ['COMMENT']), 0, $limit, "...", "UTF-8" );
		// if(mb_strlen($title>$limit)){
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
for($i = 1; $i <= $max_page; $i ++) {
	if ($i == $now) {
		echo $now . '';
	} else {
		echo '<a href=\'/pb_favorg.php?page_id=', $i, '\'>' . $i . '</a>';
	}
}
?>
