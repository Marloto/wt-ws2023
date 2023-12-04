<?php

class User {
    private $username;
    private $password;
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function check($username, $password) {
        return $this->username == $username && $this->password == $password;
    }
}