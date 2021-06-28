<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'manage_student');
// Establish database connection.
try {

    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}


// increase the memory allocated->prevent White Blank Page when Updating and Publishing Page/Post
//gia tăng thêm bộ nhớ, từ đó ngăn cản trang trống khi submit

define('WP_MEMORY_LIMIT', '64M');


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
