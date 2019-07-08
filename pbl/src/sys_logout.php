<?php
 session_start();
 unset($_SESSION);
 session_destroy();
 header('Location:http://localhost/pbl/src/sys_login.php');
?>