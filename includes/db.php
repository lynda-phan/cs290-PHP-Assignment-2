<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

if ($url) {
    $mysql_host = $url["host"];
    $mysql_user = $url["user"];
    $mysql_password = $url["pass"];
    $mysql_db = substr($url["path"], 1);
} else {
    $mysql_host = '127.0.0.1';
    $mysql_user = 'root';
    $mysql_password = '';
    $mysql_db = 'general';
}

try {
    $pdo = new PDO("mysql:host={$mysql_host}", $mysql_user, $mysql_password);

    $pdo->query("CREATE DATABASE IF NOT EXISTS {$mysql_db}");
    $pdo->query("USE {$mysql_db}");

    $tableSQL = "
        CREATE TABLE IF NOT EXISTS vs_inventory (
            id       INT AUTO_INCREMENT,
            name     VARCHAR(255) NOT NULL,
            category VARCHAR(255),
            length   INT UNSIGNED,
            rented   BOOLEAN NOT NULL DEFAULT false,
            UNIQUE (name),
            PRIMARY KEY (id)
        ) ENGINE=InnoDB
    ";

    $pdo->query($tableSQL);
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
