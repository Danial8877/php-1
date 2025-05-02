<?php

try {
    $localhost = DB__HOST;
    $username = DB__USER;
    $password = DB__PASS;
    $dbname = DB__NAME;
    $dsn = "mysql:host=$localhost;dbname=$dbname;";
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) {
    http_response_code(500);
    die;
}
