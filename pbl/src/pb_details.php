<?php
require_once ('db_inc.php');
$review_id = $_GET['REVIEW_ID'];
$store_id =$_GET['STORE_ID'];
$page_id = $_GET['page_id'];

$sql1 = "SELECT * FROM t_rstinfo WHERE STORE_ID = '$store_id' ";
$rs1 = mysql_query ( $sql1, $conn );
if (! $rs1)
	die ( 'エラー: ' . mysql_error () );
$row1 = mysql_fetch_array ( $rs1 );
// ///////////// 口コミをデータベースから呼び出す ///////////////
$sql2 = "SELECT * FROM t_review WHERE REVIEW_ID = '$review_id' ";

$rs2 = mysql_query ( $sql2, $conn );
if (! $rs2)
	die ( 'エラー: ' . mysql_error () );

$row2 = mysql_fetch_array ( $rs2 );

if ($row2) {
	$review_id = $row2 ['REVIEW_ID'];
	$evaluation_points = $row2 ['EVALUATION_POINTS'];
	$comment = $row2 ['COMMENT'];
	//$store_id = $row ['STORE_ID'];
	//if (! $review_id)
		//$review_id = $row2 ["NULL"];
	if (! $evaluation_points)
		$evaluation_points = $row2 [0];
	if (! $comment)
		$comment = $row2 ["NULL"];
	//if (! $store_id)
	//	$store_id = "NULL";
}

// ///////////// 口コミを表示 ///////////////
echo '<tr>';
echo '<td align="center"><button><a href=\'/pbl/src/pb_favorg.php?page_id=', $page_id, '\'>' .
     "戻る" . '</a></button></td>', ' ';
echo '</tr>';

echo '<h3>'.$row1['STORE_NAME'].'</h3>';

	echo '<tr><h3>';
	echo '<td>' .$review_id . '</td>';
	echo '<td>' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . "評価" . $evaluation_points . "点" . '</td>';
	echo '<hr>';
	echo '</h3>';
	echo '<h4><td>' . $comment . '</td></h4>';
	echo '</tr>';

?>