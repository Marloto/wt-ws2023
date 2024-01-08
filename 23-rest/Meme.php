<?php

class Meme implements JsonSerializable {
    private $id;
    private $upperText;
    private $lowerText;
    private $memeUrl;
    public function __construct($id = "", $memeUrl = "", $lowerText = "", $upperText = "") {
       $this->id = $id;
       $this->memeUrl = $memeUrl;
       $this->lowerText = $lowerText;
       $this->upperText = $upperText;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($value) {
        $this->id = $value;
    }
    public function getLowerText() {
        return $this->lowerText;
    }
    public function setLowerText($lowerText) {
        $this->lowerText = $lowerText;
    }
    public function getUpperText() {
        return $this->upperText;
    }
    public function setUpperText($upperText) {
        $this->upperText = $upperText;
    }
    public function getMemeUrl() {
        return $this->memeUrl;
    }
    public function setMemeUrl($memeUrl) {
        $this->memeUrl = $memeUrl;
    }
    public function jsonSerialize():mixed {
        return get_object_vars($this);
    }
    public static function fromJson($data) {
        $user = new Meme();
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }
}