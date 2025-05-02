<?php

$requestUrl = $_GET['url'] ?? '/';

$requestUrl = rtrim($requestUrl, '/');
$requestUrl = '/' . ltrim($requestUrl, '/');

$requestUrl = filter_var($requestUrl, FILTER_SANITIZE_URL);
if ($requestUrl === false) {
    http_response_code(400);
    die;
}

if ($requestUrl === '/') {
    $file = PUBLICROOT . 'index.php';
} else {
    $requestUrl = preg_replace('/\.php$/', '', $requestUrl);

    $file = PUBLICROOT . ltrim($requestUrl, '/') . '.php';
}

$realPublicRoot = realpath(PUBLICROOT);
$realFilePath = realpath($file);

if (
    $realFilePath !== false &&
    strpos($realFilePath, $realPublicRoot) === 0 &&
    is_file($realFilePath)
) {

    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    require $realFilePath;
    exit();
}

http_response_code(404);
die;
