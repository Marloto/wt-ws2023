<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', 1);
require("more.php");

// wie unterscheiden zw. "formular anzeigen" und "formular abgesendet"
// 1. Maßnahme: Prüfen ob das Formular abgesendet wurde

$errorTitleMsg = false;
$errorContentMsg = false;
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$title = "";
$content = "";
$publishedAt = "";
$author = "";
$state = "";
$rights = "";
$foo = "";

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


// Entweder Felder auf existenz prüfen, oder es gibt ein Action-Information wie über einen button, mit dessen Wert z.B. geprüft werden kann welche Aktion durchzuführen ist
if (isset($_POST["action"])) {
    // $_POST variable, enthält alle Values
    var_dump($_POST);
    // 2. Welche Informationen gibt es?
    // -> title
    // -> content
    // -> published-at
    // -> author
    // -> state
    // -> all-rights-reserved
    // -> foo

    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publishedAt = $_POST["published-at"];
    $author = $_POST["author"];
    $state = $_POST["state"];
    $rights = isset($_POST["all-rights-reserved"]) ? $_POST["all-rights-reserved"] : false;
    $foo = isset($_POST["foo"]) ? $_POST["foo"] : false;

    // 3. Was für Validierungsregeln müssen geprüft werden?
    // -> z.B. kein Feld darf leer sein
    // -> $title, $content, $publishedAt, $author prüfen

    // 4. Fehlermeldung ausgeben

    if ($_POST["action"] == "save" || $_POST["action"] == "duplicate") {
        if (empty($title)) {
            $errorTitleMsg = "Title is empty";
        }
        if (empty($content)) {
            $errorContentMsg = "Content is empty";
        }

        if ($_POST["action"] == "save" && !empty($id)) {
            saveArticle($id, $title, $content, $publishedAt, $author, $state, $rights, $foo);
        } else {
            $id = uniqid();
            saveArticle($id, $title, $content, $publishedAt, $author, $state, $rights, $foo);
        }
    }
}

// Warum nicht einfach JS nehmen um Formulare zu validieren?
// -> JS kann angepasst im Browser, ist einsehbar, kann modifiziert werden, so dass es macht was der Nutzer will
// -> PHP wird im Server ausgeführt, kann nicht modifiziert oder eingesehen werden, daher vertraunswürdiger als der Browser
// -> JS nutzen um gute Oberflächen mit Nutzerfeedback zu realisieren
// -> PHP (oder andere Backends) sollten immer die Eingaben überprüfen auf plausibilität

// Einlesen
if (!empty($id)) {
    $article = loadArticle($_GET["id"]);

    // var_dump($article);
    $title = $article->title;
    $content = $article->content;
    $publishedAt = $article->publishedAt;
    $author = $article->author;
    $state = $article->state;
    $rights = isset($article->rights) ? $article->rights : false;
    $foo = isset($article->foo) ? $article->foo : false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error-msg {
            color: red;
        }

        .is-invalid {
            border-color: red;
        }
    </style>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <h1>Edit Blog Post</h1>
        <form method="post">
            <?php if ($errorTitleMsg) { ?>
                <p class="error-msg"><?= $errorTitleMsg; ?></p>
            <?php } ?>
            <?php if ($errorContentMsg) { ?>
                <p class="error-msg"><?= $errorContentMsg; ?></p>
            <?php } ?>
            <p>
                <label for="title">Title:</label>
                <input <?php if ($errorTitleMsg) { ?>class="is-invalid" <?php } ?> type="text" id="title" name="title" value="<?= $title ?>">
            </p>
            <p>
                <label for="content">Content:</label>
                <textarea <?php if ($errorContentMsg) { ?>class="is-invalid" <?php } ?> name="content" id="content"><?= $content ?></textarea>
            </p>
            <p>
                <label for="published-at">Published At:</label>
                <input type="date" id="published-at" name="published-at" value="<?= $publishedAt ?>">
            </p>
            <p>
                <label for="author">Author:</label>
                <input type="email" name="author" id="author" value="<?= $author ?>">
            </p>
            <p>
                <input type="checkbox" name="all-rights-reserved" id="all-rights-reserved" value="1" <?= $rights == "1" ? "checked" : "" ?>>
                <label for="all-rights-reserved">All Image Rights are available?</label>
            </p>
            <p>
                <input type="radio" id="a" value="1" name="foo" <?= $foo == "1" ? "checked" : "" ?>>
                <label for="a">A</label><br>
                <input type="radio" id="b" value="2" name="foo" <?= $foo == "2" ? "checked" : "" ?>>
                <label for="b">B</label><br>
                <input type="radio" id="c" value="3" name="foo" <?= $foo == "3" ? "checked" : "" ?>>
                <label for="c">C</label><br>
            </p>
            <p>
                <label for="state">Status:</label>
                <select name="state">
                    <?php
                    $states = array("Published", "Review", "New");
                    for ($i = 0; $i < count($states); $i++) { ?>
                        <option <?= $state == $states[$i] ? "selected" : "" ?>><?= $states[$i] ?></option>
                    <?php } ?>
                    ?>
                    <!--option <?php if ($state == 'Published') echo 'selected' ?>>Published</option>
                <option <?php echo $state == 'Review' ? "selected" : "" ?>>Review</option>
                <option <?= $state == 'New' ? "selected" : "" ?>>New</option-->
                </select>
            </p>
            <p>
                <input type="hidden" name="id" value="<?= $id ?>" />
                <button name="action" type="submit" value="delete">Delete</button>
                <?php if (!empty($id)) { ?>
                    <button name="action" type="submit" value="duplicate">Duplicate</button>
                <?php } ?>
                <button name="action" type="submit" value="save">Save</button>
                <!--input value="Save" name="action" class="" id="" type="submit">
            <input value="Duplicate" name="action" class="" id="" type="submit"-->
            </p>
        </form>
        <h2>Select Blog Post</h2>
        <ul>
            <?php
            $articles = listArticles();
            foreach ($articles as $article) {
                $parts = explode(".", $article);
                $articleId = $parts[0];
            ?>
                <li><a href="?id=<?= $articleId ?>"><?= $articleId ?></a></li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>