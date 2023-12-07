<?php
namespace Model;
// -> Model\User
use JsonSerializable;
class User implements JsonSerializable {
    private $username;
    private $foo;
    public function __construct($username) {
        $this->username = $username;
        $this->foo = "abc";
    }
    public function getUsername() {
        return $this->username;
    }
    public function jsonSerialize():mixed {
        return get_object_vars($this);
    }
    public static function fromJson($data) {
        $user = new User("");
        //$user->username = $data->username;
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }
}