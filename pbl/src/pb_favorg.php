<h2>ココすこ！！</h2>
<?php
require_once ('db_inc.php');
// ///////////// ホーム画面から店舗のデータを受け取る ///////////////
session_start ();
$STORE_ID = $_GET['STORE_ID'];
$LOGIN_ID = $_SESSION ['USER_ID'];
$UROLE = $_SESSION ['urole'];


// ///////////// 店舗情報をデータベースから呼び出す ///////////////
$sql = "SELECT * FROM t_rstinfo WHERE STORE_ID = '$STORE_ID'";
$rs = mysql_query ( $sql, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );

$AVG = "SELECT AVG(EVALUATION_POINTS) as avg FROM t_review WHERE STORE_ID='$STORE_ID'";

$rs2 = mysql_query ( $AVG, $conn );
if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

// ///////////// 問合せ結果を取得し、それぞれの変数に代入しておく ///////////////
$row = mysql_fetch_array ( $rs );
if ($row) {
	$STORE_ID = $row ['STORE_ID'];
	$STORE_NAME = $row ['STORE_NAME'];
	$ADDRESS = $row ['ADDRESS'];
	$OP_HOUR = $row ['OP_HOUR'];
	$OP_MIN = $row ['OP_MIN'];
	$CL_HOUR = $row ['CL_HOUR'];
	$CL_MIN = $row ['CL_MIN'];
	$HP_URL = $row ['HP_URL'];
	$USER_ID = $row ['USER_ID'];
}

$avg = mysql_fetch_array ( $rs2 );
if ($avg) {
	$EVALUATION = $avg ['avg'];
}
$AVG_EVALUATION=floor ( $EVALUATION * pow ( 10, 1 ) ) / pow ( 10, 1 );
$sql = "UPDATE t_rstinfo set EVALUATION='{$AVG_EVALUATION}' WHERE STORE_ID ='{$STORE_ID}'";
$rs3 = mysql_query ( $sql, $conn );
if (! $rs3)
	die ( 'エラー: ' . mysql_error () );

// ///////////// ボタン表示 ///////////////
echo '<tr>';
if(!isset($_GET['search'])){
echo '<td align="center"><button><a href="pb_home.php?page_id=1">戻る</a></button></td>';
}else{
	echo '<td align="center"><button><a href="pb_home.php?page_id=1&search='.$_GET['search'].'">戻る</a></button></td>';
}
if ($USER_ID == $LOGIN_ID) {
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
	      <a href="str_edit.php?&STORE_ID=' . $STORE_ID .'&STORE_NAME=' . $STORE_NAME. '">店舗編集</a></button></td>';

	echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>
		<a href="str_delete.php?STORE_ID=' . $STORE_ID . '&STORE_NAME=' . $STORE_NAME .'">店舗削除</a></button></td>';
}
	echo '<td align="center">' . '&nbsp;' . '&nbsp;' .'&nbsp;' . '<button><a href="sys_logout.php">ログアウト</a>
		 </button></td>';


echo '</tr>';
echo '<br>';

// ///////////// 店舗情報 ///////////////
echo '<tr>' . '<h3>';
echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . $STORE_NAME . '</td>';
echo '<td>' . '&nbsp;' . '&nbsp;' . "評価" . floor ( $EVALUATION * pow ( 10, 1 ) ) / pow ( 10, 1 ) . "点" . '</td>';
echo '<br>';
echo '<td>' . "住所" . '&nbsp;' . '&nbsp;' . $ADDRESS . '</td>';
echo '<br>';
$HOLIDAY = array (
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
		$OP_HOUR = array(
		   -1 =>'--',
			0 =>'0',
			1 =>'1',
			2 =>'2',
			3 =>'3',
			4 =>'4',
			5 =>'5',
			6 =>'6',
			7 =>'7',
			8 =>'8',
			9 =>'9',
			10 =>'10',
			11 =>'11',
			12 =>'12',
			13 =>'13',
			14 =>'14',
			15 =>'15',
			16 =>'16',
			17 =>'17',
			18 =>'18',
			19 =>'19',
			20 =>'20',
			21 =>'21',
			22 =>'22',
			23 =>'23'
		);
		$j = $row ['OP_HOUR'];
		$OP_MIN=array(
				-1 => '--',
				0 =>'00',
				1 =>'10',
				2 =>'20',
				3 =>'30',
				4 =>'40',
				5 =>'50',


		);
		$k = $row ['OP_MIN'];
		$CL_HOUR = array(
				-1 => '--',
				0 =>'0',
				1 =>'1',
				2 =>'2',
				3 =>'3',
				4 =>'4',
				5 =>'5',
				6 =>'6',
				7 =>'7',
				8 =>'8',
				9 =>'9',
				10 =>'10',
				11 =>'11',
				12 =>'12',
				13 =>'13',
				14 =>'14',
				15 =>'15',
				16 =>'16',
				17 =>'17',
				18 =>'18',
				19 =>'19',
				20 =>'20',
				21 =>'21',
				22 =>'22',
				23 =>'23'
		);
		$l = $row ['CL_HOUR'];
		$CL_MIN=array(
				-1 => '--',
				0 =>'00',
				1 =>'10',
				2 =>'20',
				3 =>'30',
				4 =>'40',
				5 =>'50',
		);
		$m = $row ['CL_MIN'];
		if($j==-1||$k==-1||$l==-1||$m==-1){
			echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' ."--". '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $HOLIDAY [$i] . '</td>';
		}else{
			echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . $OP_HOUR[$j] . "：" . $OP_MIN[$k] . "～" . $CL_HOUR[$l] . "：" . $CL_MIN[$m] . '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $HOLIDAY [$i] . '</td>';
		}
echo '<br>';

$MOVE_TIME = array (
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
echo '<td>' . "移動時間" . '&nbsp;' . '&nbsp;' . $MOVE_TIME [$j] . '</td>';
echo '<br>';

if ($HP_URL == NULL) {
	echo '<td>' . "ホームページのURL" . '&nbsp;' . '&nbsp;' . '--' . '</td>';
} else {
	echo '<td>' . "ホームページのURL" . '&nbsp;' . '&nbsp;' . '<a href=',$row['HP_URL'],'>' . $HP_URL . '</a>' . '</td>';
}
echo '<br>';

if ($UROLE == 1) {
	echo '<td align="center"><button><a href="rev_registration.php?STORE_ID='.$STORE_ID.'&STORE_NAME='.$STORE_NAME.'">口コミ登録</a></button></td>';

}
echo '</h3>' . '</tr>';
echo '<hr>';

// ///////////// 口コミをデータベースから呼び出す ///////////////
$cnt = "SELECT COUNT(*) as cnt FROM t_review WHERE STORE_ID='$STORE_ID'";

$rs3 = mysql_query ( $cnt, $conn );
if (! $rs3)
	die ( 'エラー: ' . mysql_error () );
$ecnt = mysql_fetch_array ( $rs3 );
if ($ecnt) {
	$cnt = $ecnt ['cnt'];
}
$max_page = ceil ( $cnt / 10 );
if ($_GET ['page_id'] == 1) {
	$max = "SELECT * FROM t_review WHERE STORE_ID ='$STORE_ID'LIMIT 10  ";
} else {
	for($i = 1; $i <= $_GET ['page_id']; $i ++) {
		$max = "SELECT * FROM t_review WHERE STORE_ID ='$STORE_ID  'LIMIT 10 OFFSET " . $i;
	}
}

$rs = mysql_query ( $max, $conn );

if (! $rs)
	die ( 'エラー: ' . mysql_error () );

$row = mysql_fetch_array ( $rs );
$REVIEW_ID = NULL;
if ($row) {
	$REVIEW_ID = $row ['REVIEW_ID'];
	$EVALUATION_POINTS = $row ['EVALUATION_POINTS'];
	$COMMENT = $row ['COMMENT'];
	$CUSER_ID = $row ['USER_ID'];
	$STORE_ID = $row ['STORE_ID'];
}

if (! isset ( $_GET ['page_id'] )) {
	$now = 1;
} else {
	$now = $_GET ['page_id'];
}

while ( $row ) {
	echo '<tr>';
	echo '<td>' . $row ['USER_ID'] . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "評価" . $row ['EVALUATION_POINTS'] . "点" . '</td>';
	if ($row ['USER_ID'] == $LOGIN_ID) {
		echo '<td align="center">' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '<button>' .
		     '<a href="rev_delete.php?&page_id='.$_GET['page_id'].'&STORE_ID=' . $STORE_ID .'&STORE_NAME=' . $STORE_NAME .'&REVIEW_ID='.$row['REVIEW_ID'].'">' .
		     "口コミ削除" . '</a>' . '</button>' . '</td>';
	}
	echo '<br>';

	$limit = 29;
	if (mb_strlen ( $row ['COMMENT'] ) >= $limit) {
		$title = mb_strimwidth ( ($row ['COMMENT']), 0, $limit, "...", "UTF-8" );

		echo '<td>' . $title . '</td>';
		echo '<td><a href="pb_details.php?REVIEW_ID='.$row['REVIEW_ID'].'&STORE_ID=' . $STORE_ID . '&page_id='.$_GET['page_id'].'">もっと見る</a></td>';
	} else {
		echo '<td>' . $row ['COMMENT'] . '</td>';
	}

	echo '<br>';
	echo '</td>';
	echo '</tr>';
	echo '<hr>';
	$row = mysql_fetch_array ( $rs ); // 次の行へ
}
if($REVIEW_ID==NULL){
	echo'<h3>'."口コミは登録されていません".'</h3>';
}
// ///////////// ページの処理 ///////////////
for($i = 1; $i <= $max_page; $i ++) {
	if ($i == $now) {
		echo $now . ' ';
	} else if ($i == 1) {
		echo '<a href=\'/pbl/src/pb_favorg.php?page_id=', $i,'&STORE_ID=' . $STORE_ID .'\'>' . $i . '</a>', ' ';
	} else {
		echo '<a href=\'/pbl/src/pb_favorg.php?page_id=', (($i * 10) - 10), '&STORE_ID=' . $STORE_ID .'\'>' . $i . '</a>', ' ';
	}
}

?>
