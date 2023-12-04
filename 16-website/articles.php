<?php
$folder = "files";
function saveArticle($id, $title, $content, $publishedAt, $author, $state, $rights, $foo)
{
    global $folder;
    $path = $folder . "/" . $id . ".json";
    $articleData = array(
        "id" => $id,
        "title" => $title,
        "content" => $content,
        "publishedAt" => $publishedAt,
        "author" => $author,
        "state" => $state,
        "rights" => $rights,
        "foo" => $foo
    );
    $rawData = json_encode($articleData);
    $fp = fopen($path, 'w');
    fwrite($fp, $rawData);
    fclose($fp);
}

function loadArticle($id)
{
    global $folder;
    $path = $folder . "/" . $id . ".json";
    if (file_exists($path)) {
        $rawData = file_get_contents($path);
        $articleData = json_decode($rawData);
        return $articleData;
    }
}

function listArticles()
{
    global $folder;
    return array_diff(scandir($folder), array('..', '.'));
}
