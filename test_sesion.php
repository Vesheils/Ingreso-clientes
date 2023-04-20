<?php
session_start();
$_SESSION['test'] = 'test_value';
echo 'Session ID: ' . session_id();
?>
