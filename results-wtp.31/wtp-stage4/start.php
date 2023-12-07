<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', '9034a823-ee66-478f-9464-2ea2bbd85d6d'); # Ihre Collection ID

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
?>