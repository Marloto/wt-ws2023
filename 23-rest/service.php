<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

if(!isset($_SESSION["memes"])) {
    $memes = array();
    $memes[] = new Meme("123", "Memes", "Memes Everywhere", "images/1c7cy8.jpg");
    $memes[] = new Meme("124", "Memes2", "Memes2 Everywhere", "images/1c7cy8.jpg");
    $_SESSION["memes"] = $memes;
}

$memes = $_SESSION["memes"];

$url = $_GET["_url"];
$httpMethod = $_SERVER["REQUEST_METHOD"];
$body = file_get_contents("php://input"); // String Content der Anfrage

if($url == "/meme" && $httpMethod == "GET") {
    echo json_encode($memes);
} else if(str_starts_with($url, "/meme/") && $httpMethod == "GET") {
    // vermutung /meme/123 -> wir wollen das eine Element zurückgeben
    $idParts = explode("/", $url);
    $id = $idParts[2];
    // iteration durch das Array zur Suche mit passender ID
    $found = false;
    foreach($memes as $value) {
        if($value->getId() == $id) {
            echo json_encode($value);
            $found = true;
            break;
        }
    }
    if(!$found) {
        http_response_code(404);
    }
} else if($url == "/meme" && $httpMethod == "POST") {
    http_response_code(201);
    $rawData = json_decode($body);
    $meme = Meme::fromJson($rawData);
    $uniqid = uniqid();
    $meme->setId($uniqid);
    $memes[] = $meme;
    header("Location: http://localhost/23-rest/meme/" . $uniqid);
} else if(str_starts_with($url, "/meme/") && $httpMethod == "PUT") {
    // $idParts = explode("/", $url);
    // $id = $idParts[2];
    // $rawData = json_decode($body);
    // $meme = Meme::fromJson($rawData);
    // suchen, und aktualisieren
    // http_response_code(204);
    // 404, wenn nicht gefunden
} else if(str_starts_with($url, "/meme/") && $httpMethod == "DELETE") {
    // $idParts = explode("/", $url);
    // $id = $idParts[2];
    // -> $memes durchsuchen und das Element löschen, siehe Google
    // -> 404 wenn nicht gefunden od. 204 für erfolg
}

// TODO: PUT und DELETE

$_SESSION["memes"] = $memes;

// echo "Hello, World!";
// echo "<hr>";
// echo $url;
// echo "<hr>";
// echo $httpMethod;
// echo "<hr>";
// echo json_encode($memes);
// http_response_code(404);