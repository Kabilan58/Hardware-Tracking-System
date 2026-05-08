<?php
// Modernized DB connection for PHP 7/8 using MySQLi
$host = "localhost";
$port = 3306;
$user = "root";
$pass = "";
$db   = "hts";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = mysqli_connect($host, $user, $pass, $db, $port);
    mysqli_set_charset($conn, "utf8mb4");
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>