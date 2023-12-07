<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Backend aufrufen
$friends = $service->loadFriends();
if ($friends) {
    // erhaltene Friend-Objekte im JSON-Format senden 
    echo json_encode($friends);
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
http_response_code($friends ? 200 : 404);
?>
