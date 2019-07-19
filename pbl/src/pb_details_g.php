<?php
require_once ('db_inc.php');
$REVIEW_ID = $_GET['REVIEW_ID'];
$STORE_ID =$_GET['STORE_ID'];
$PAGE_ID = $_GET['page_id'];

$sql1 = "SELECT * FROM t_rstinfo WHERE STORE_ID = '$STORE_ID' ";
$rs1 = mysql_query ( $sql1, $conn );
if (! $rs1)
	die ( 'エラー: ' . mysql_error () );
$row1 = mysql_fetch_array ( $rs1 );
// ///////////// 口コミをデータベースから呼び出す ///////////////
$sql2 = "SELECT * FROM t_review WHERE REVIEW_ID = '$REVIEW_ID' ";

$rs2 = mysql_query ( $sql2, $conn );
if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

$row2 = mysql_fetch_array ( $rs2 );

if ($row2) {
	$USER_ID = $row2 ['USER_ID'];
	$EVALUATION_POINTS = $row2 ['EVALUATION_POINTS'];
	$COMMENT = $row2 ['COMMENT'];
	if (! $EVALUATION_POINTS)
		$EVALUATION_POINTS = $row2 [0];
	if (! $COMMENT)
		$COMMENT = $row2 ["NULL"];

}

// ///////////// 口コミを表示 ///////////////
echo '<tr>';
echo '<td align="center"><button><a href=\'/pbl/src/pb_favorg_g.php?page_id=', $PAGE_ID,'&STORE_ID=', $STORE_ID, '\'>' .
     "戻る" . '</a></button></td>', ' ';
echo '</tr>';

echo '<h3>'.$row1['STORE_NAME'].'</h3>';

	echo '<tr><h3>';
	echo '<td>' .$USER_ID . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "評価" . $EVALUATION_POINTS . "点" . '</td>';
	echo '<hr>';
	echo '</h3>';
	echo '<h4><td>' . $COMMENT . '</td></h4>';
	echo '</tr>';

?>