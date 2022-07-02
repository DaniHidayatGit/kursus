<?php

define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'kursusq');

/**
 * $con : koneksi kedatabase
 */
$con = new mysqli(dbhost, dbuser, dbpass, dbname);

/**
 * Check Error yang terjadi saat koneksi
 * jika terdapat error maka die() // stop dan tampilkan error
 */
    if ($con->connect_error) {
        die('Database Not Connect. Error : ' . $con->connect_error);
    }
?>