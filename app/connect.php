<?php 

require("config.php");
try {
    $dsn="pgsql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $conn;
} catch (\PDOException $e) {
    echo "error". $e->getMessage() ."";
    die();
}