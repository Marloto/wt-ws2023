<?php
namespace Utils;

use Model\Friend;
use Model\User;

class BackendService{
    public $link = "";
    private $base = "";
    private $id = "";
    
    /**
     * Erzeugt eine Instanz des BackendService.
     * @param $base Basisadresse des Backends
     * @param $id Collection ID
     */
    public function __construct($base, $id) {
        $this->link = $base . $id; 
        $this->base = $base;
        $this->id = $id;
    }

    /**
     * Liefert true, wenn eine gültige Benutzername/Password-Kombination
     * übergeben wurde. Zudem wird das erhaltene Token in der Session
     * gespeichert.
     * Im Fehlerfall wird false zurückgegeben.
     * @param $username string mit dem username
     * @param $password string mit dem password
     */
    public function login($username, $password){
        try{
            $result = HttpClient::post($this->link . "/login", array(
                "username" => $username,
                "password" => $password
            ));
            $_SESSION["chat_token"] = $result->token;
            return true;
        }catch (\Exception $e){
            error_log($e);
            var_dump($e);
        }
        return false;
    }
    /**
     * Registriert einen neuen Benutzer mit Benutername und Passwort.
     * Der neue Benutzer wird eingeloggt, zudem wird das erhaltene Token 
     * in der Session gespeichert. Im Erfolgsfall wird true zurückgegeben.
     * Im Fehlerfall wird false zurückgegeben.
     * @param $username string mit dem username
     * @param $password string mit dem password
     */
    public function register($username, $password){
        try{
            $result = HttpClient::post($this->link . "/register", array(
                "username" => $username,
                "password" => $password
            ));
            $_SESSION["chat_token"] = $result->token;
            return true;
        } catch (\Exception $e){
            error_log($e);
        }
        return false;
    }
    
    /**
     * Liefert ein Benutzerobjekt zu $username oder `false`.
     * @param $username string mit dem username des zu ladenden Profils
     */
    public function loadUser($username){
        try {
            $user = HttpClient::get($this->link . "/user/" . $username, $_SESSION["chat_token"]);
            return User::fromJson($user);
        } catch (\Exception $e) {
            error_log($e);
        }
        return false;
    }
    /**
     * Speichert die übergebenen Benutzerdaten.
     * @param $user erwartet ein PHP array:
     *   { "<einstellung1>" => "<wert1>", "<einstellung2>" => "<wert2>"}
     *   Wichtig: das `username`-Attribut muss gesetzt sein!
     * @return true bei Erfolg oder false im Fehlerfall
     */
    public function saveUser($user){
        try {
            HttpClient::put($this->link . "/user/" . $user->getUsername(), $user, $_SESSION["chat_token"]);
            return true;
        } catch (\Exception $e) {
            error_log($e);
        }
        return false;
    }
    /**
     * Lädt alle Nachrichten zwischen dem aktuellen Benutzer (anhand Token bestimmbar) und
     * dem Benutzer $chatpartner.
     * @see https://online-lectures-cs.thi.de/chat/full#list-messages
     * @param $chatpartner string mit dem username des chatpartners
     * @return array mit Nachrichten oder false im Fehlerfall
     */
    public function loadMessages($chatpartner){
        try{
            $messages = HttpClient::get($this->link . "/message/" . $chatpartner, 
                $_SESSION["chat_token"]);
            return $messages;
        } catch(\Exception $e){
            error_log($e);
        }
        return false;
    }
    /**
     * Lädt alle Freunde des aktuellen Benutzers.
     * @see https://online-lectures-cs.thi.de/chat/full#list-friends
     * @return array mit Friend-Objekten oder false im Fehlerfall
     */
    public function loadFriends(){
        try{
            $friend = HttpClient::get($this->link . "/friend", $_SESSION["chat_token"]);
            $friends = array();
            foreach($friend as $element){
                $friends[] = Friend::fromJson($element);
            }
            return $friends;
        } catch(\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Liefert alle existierenden Benutzer oder `false` im Fehlerfall.
     * @see https://online-lectures-cs.thi.de/chat/full#load-user
     */
    public function loadUsers() {
        try{
            $users = HttpClient::get($this->link . "/user", $_SESSION["chat_token"]);
            return $users;
        }catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Sendet eine Nachricht, liefert true bei Erfolg.
     * $message sollte ein Standard Object sein mit den Fields "msg" und "to"
     */
    public function sendMessage($message) {
        try {
            $reply = HttpClient::post($this->link . "/message",
                array("message" => $message->msg, "to" => $message->to),
                $_SESSION["chat_token"]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Erzeugt eine Freunschaftsanfrage.
     * @see https://online-lectures-cs.thi.de/chat/full#friend-request
     * @param $friend array mit {"username"=> "<username des neuen Freundes>"}
     * @return true bei Erfolg, sonst false
     */
    public function friendRequest($friend){
        try{
            HttpClient::post($this->link . "/friend", $friend, $_SESSION["chat_token"]);
            return true;
        } catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Akzeptiere eine Freunschaftsanfrage bzgl. Benutzer $friend
     * @param $friend string mit dem username des Freundes
     * @see https://online-lectures-cs.thi.de/chat/full#friend-accept
     * @return true bei Erfolg, sonst false 
     */
    public function friendAccept($friend){
        try{
            HttpClient::put($this->link . "/friend/" . $friend, array("status" => "accepted"), $_SESSION["chat_token"]);
            return true;
        }catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Lehne eine Freunschaftsanfrage bzgl. Benutzer $friend ab
     * @param $friend string mit dem username des Freundes
     * @see https://online-lectures-cs.thi.de/chat/full#friend-accept
     * @return true bei Erfolg, sonst false 
     */
    public function friendDismiss($friend){
        try{
            HttpClient::put($this->link . "/friend/" . $friend, array("status" => "dismissed"), $_SESSION["chat_token"]);
            return true;
        }catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Löscht den Freund namens $friend aus der eigenen Freundesliste.
     * @see https://online-lectures-cs.thi.de/chat/full#friend-remove
     * @param $friend string mit dem username des freundes, der entfernt werden soll
     * @return true bei Erfolg, sonst false
     */
    public function removeFriend($friend){
        try{
            HttpClient::delete($this->link . "/friend/" . $friend, $_SESSION["chat_token"]);
            return true;
        }catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    /**
     * Liefert true, wenn $username existiert ,sonst false.
     * @param $username string mit dem username
     */
    public function userExists($username){
        try {
            HttpClient::get($this->link . "/user/" . $username);
            return true;
        } catch (\Exception $e) {
            error_log($e);
        }
        return false;
    }

    
    /**
     * Liefert die Liste der Freund mit der Anzahl ungelesener Nachrichten 
     * zu jedem Freund.
     * @see https://online-lectures-cs.thi.de/chat/full#unread
     * @return Nachrichtenliste oder false bei Fehler
     */
    public function getUnread(){
        try{
            $unread = HttpClient::get($this->link . "/unread", $_SESSION["chat_token"]);
            return $unread;
        }catch (\Exception $e){
            error_log($e);
        }
        return false;
    }

    public function test() {
        try {
            return HttpClient::get($this->base . '/test.json');
        } catch(\Exception $e) {
            error_log($e);
        }
        return false;
    }
}
?>