<?php
require_once 'includes/db.php';

$_SESSION = [];
session_destroy();

redirect('login.php');
