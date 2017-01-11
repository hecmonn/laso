<?php
require_once("Database.php");
require_once("includes.php");
require_once("Sessions.php");

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

?>
