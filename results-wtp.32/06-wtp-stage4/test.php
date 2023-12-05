<?php

use Utils\BackendService;

require("start.php");

$user = new Model\User("Tom");
echo $user->getUsername() . "<br>";
// ----
echo "<hr>";
$jsonStr = json_encode($user);
echo $jsonStr . "<br>";
// ----
echo "<hr>";
$newUserObj = json_decode($jsonStr);
var_dump($newUserObj);
// ----
echo "<hr>";
$newUserObj2 = Model\User::fromJson($newUserObj);
var_dump($newUserObj2);
// ----
echo "<hr>";
$friend = new Model\Friend();
var_dump($friend);
// ----
echo "<hr>";
// https://online-lectures-cs.thi.de/chat/full/9034a823-ee66-478f-9464-2ea2bbd85d6d

$res = $service->test();
var_dump($res);
// ----
echo "<hr>";
var_dump($service->login("Tom", "12345678"));
echo $_SESSION["chat_token"];
// ----
echo "<hr>";
//var_dump($service->register("Tom3", "12345678"));
var_dump($service->loadUser("Tom"));