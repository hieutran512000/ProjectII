<?php
// Database config
define('DATABASE_HOST', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASS', '');
define('DATABASE_NAME', "itecblog2021_2");

session_start();

$conn = new mysqli(
    DATABASE_HOST,
    DATABASE_USER,
    DATABASE_PASS,
    DATABASE_NAME
);

define('UPLOAD_PATH', 'uploads');