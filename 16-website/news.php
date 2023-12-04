<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', 1);

// Lesen von JSON Daten

require("articles.php");


$articles = listArticles();
$result = array();
foreach ($articles as $article) {
    $parts = explode(".", $article);
    $articleId = $parts[0];
    $result[] = loadArticle($articleId);
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);
?>