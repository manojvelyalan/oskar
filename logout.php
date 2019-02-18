<?php
require_once 'class/classCommon.php';
$cloudModel = new oskar\common;
Parse\ParseUser::logOut();
header("Location:login");

