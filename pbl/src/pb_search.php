<?php
	$search = $_POST['search'];
	echo $search;
	header('Location:pb_home.php?page_id=1&search='.$search);
?>