<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Body der HTTP-Nachricht lesen, sollte im Format { "msg": string, "to": string } sein
$messageBody = file_get_contents('php://input');
// PHP Standard Objekt aus JSON-OBjekt erzeugen 
$message = json_decode($messageBody);
// Nachricht senden
$ok = $service->sendMessage($message);
/* http status code setzen
 * - 204 Nachricht gesendet
 * - 404 Fehler
 */
http_response_code($ok ? 204 : 404);
?>