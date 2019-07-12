<h2>ココすこ！！</h2>

<?php
require_once ('db_inc.php');

$page_id = $_GET ['page_id'];
echo '<tr>';

echo '<td align="center"><button><a href="sys_logout.php">ログアウト</a>
		 </button></td>';

?>
</tr>
<br>
<br>
<form action="pb_search_g.php" method="post">
	<td><input type="text" name="search" value=""> <td align="center">&nbsp;&nbsp;&nbsp;<input
		type="submit" value="検索"></td>

<br>
<?php
if (isset ( $_GET ['search'] )) {
	$search = $_GET ['search'];
} else {
	$search = NULL;
}
?>


	</form>
<?php

// ///////////// 店舗情報をデータベースから呼び出す ///////////////
if ($search == NULL) {
	$cnt = "SELECT COUNT(*) as cnt FROM t_rstinfo WHERE STORE_ID";
} else {
	$cnt = "SELECT COUNT(*) as cnt FROM t_rstinfo WHERE STORE_NAME LIKE '%$search%'";
}
$rs = mysql_query ( $cnt, $conn );
if (! $rs)
	die ( 'エラー: ' . mysql_error () );
$ecnt = mysql_fetch_array ( $rs );

if ($ecnt) {
	$cnt = $ecnt ['cnt'];
}

$max_page = ceil ( $cnt / 10 );
if ($_GET ['page_id'] == 1 && $search == NULL) {
	$max = "SELECT * FROM t_rstinfo LIMIT 10";
} elseif ($_GET ['page_id'] != 1 && $search == NULL) {
	for($i = 1; $i <= $_GET ['page_id']; $i ++) {
		$max = "SELECT * FROM t_rstinfo  LIMIT 10 OFFSET " . $i;
	}
	} else if ($_GET ['page_id'] == 1 && $search != NULL) {
		$max = "SELECT * FROM t_rstinfo WHERE STORE_NAME LIKE '%$search%'";
} elseif ($_GET ['page_id'] != 1&& $search != NULL) {
	for($i = 1; $i <= $_GET ['page_id']; $i ++) {
		$max = "SELECT * FROM t_rstinfo  LIMIT 10 OFFSET " . $i;
	}
}
	$rs2 = mysql_query ( $max, $conn );

if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

$row = mysql_fetch_array ($rs2);
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
}


if (! isset ( $_GET ['page_id'] )) {
	$now = 1;
} else {
	$now = $_GET ['page_id'];
}
while ($row) {
	echo '<tr>' . '<h3>';
	if (! isset ( $_GET ['search'] )) {
		echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . '<a href="/pbl/src/pb_favorg_g.php?page_id='.$page_id.'&STORE_ID=' . $row ['STORE_ID'] . '">' . $row ['STORE_NAME'] . '</a>' . '</td>';
	} else {
		echo '<td>' . "店舗名" . '&nbsp;' . '&nbsp;' . '<a href="/pbl/src/pb_favorg_g.php?page_id='.$page_id.'&STORE_ID=' . $row ['STORE_ID'] . '&search=' . $_GET ['search'] . '">' . $row ['STORE_NAME'] . '</a>' . '</td>';
	}

	echo '<td>' . '&nbsp;' . '&nbsp;' . "評価" .  $row['EVALUATION']. "点" . '</td>';
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
$OP_HOUR = array (
			- 1 => '--',
			0 => '0',
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
			5 => '5',
			6 => '6',
			7 => '7',
			8 => '8',
			9 => '9',
			10 => '10',
			11 => '11',
			12 => '12',
			13 => '13',
			14 => '14',
			15 => '15',
			16 => '16',
			17 => '17',
			18 => '18',
			19 => '19',
			20 => '20',
			21 => '21',
			22 => '22',
			23 => '23'
	);
	$j = $row ['OP_HOUR'];
	$OP_MIN = array (
			- 1 => '--',
			0 => '00',
			1 => '10',
			2 => '20',
			3 => '30',
			4 => '40',
			5 => '50'
	)
	;
	$k = $row ['OP_MIN'];
	$CL_HOUR = array (
			- 1 => '--',
			0 => '0',
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
			5 => '5',
			6 => '6',
			7 => '7',
			8 => '8',
			9 => '9',
			10 => '10',
			11 => '11',
			12 => '12',
			13 => '13',
			14 => '14',
			15 => '15',
			16 => '16',
			17 => '17',
			18 => '18',
			19 => '19',
			20 => '20',
			21 => '21',
			22 => '22',
			23 => '23'
	);
	$l = $row ['CL_HOUR'];
	$CL_MIN = array (
			- 1 => '--',
			0 => '00',
			1 => '10',
			2 => '20',
			3 => '30',
			4 => '40',
			5 => '50'
	);
	$m = $row ['CL_MIN'];
	if ($j == - 1 || $k == - 1 || $l == - 1 || $m == - 1) {
		echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . "--" . '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $HOLIDAY [$i] . '</td>';
	} else {
		echo '<td>' . "営業時間" . '&nbsp;' . '&nbsp;' . $OP_HOUR [$j] . "：" . $OP_MIN [$k] . "～" . $CL_HOUR [$l] . "：" . $CL_MIN [$m] . '&nbsp;' . '&nbsp;' . "定休日" . '&nbsp;' . '&nbsp;' . $HOLIDAY [$i] . '</td>';
	}	echo '<br>';

	echo '</h3>' . '</tr>';
	echo '<hr>';


	$row = mysql_fetch_array ($rs2 ); // 次の行へ

}

// ///////////// ページの処理 ///////////////
for($i = 1; $i <= $max_page; $i ++) {
	if ($i == $now) {
		echo $now . ' ';
	} else if ($i == 1) {
		echo '<a href=\'/pbl/src/pb_home_g.php?page_id=', $i, '\'>' . $i . '</a>', ' ';
	} else {
		echo '<a href=\'/pbl/src/pb_home_g.php?page_id=', (($i * 10) - 10), '\'>' . $i . '</a>', ' ';
	}
}

?>
