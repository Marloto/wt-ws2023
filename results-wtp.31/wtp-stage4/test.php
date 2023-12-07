<?php
require("start.php");
echo CHAT_SERVER_ID;
echo "<hr>";
$user = new Model\User("Tom");
var_dump($user);
echo "<hr>";
$jsonStr = json_encode($user); // vom typ string, z.B. {"username":"Tom","foo":"abc"}
echo $jsonStr;
echo "<hr>";
$newObj = json_decode($jsonStr);
var_dump($newObj);
echo "<hr>";

var_dump($service->login("Tom", "12345678"));
echo "<hr>";
var_dump($service->loadUsers());

echo "<hr>";
var_dump($service->register("Tom6", "12345678"));
echo "<hr>";
var_dump($service->loadUsers());