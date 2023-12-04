<?php
// In PHP wird der Punkt für String-Verknüpfung verwendet
class SomeClass {
    private $someAttr;
    public function __construct($someParam) {
        $this->someAttr = $someParam;
        // vgl. Java this.someAttr = someParam;
    }

    public function getSomeAttr() {
        return $this->someAttr;
    }

    public function setSomeAttr($someAttr) {
        $this->someAttr = $someAttr;
    }

    public static function someExample() {
        echo "Hello, World!";
    }
}

$obj = new SomeClass(123);
$value = $obj->getSomeAttr();

// vgl. in Java SomeClass.someExample(); für den Aufruf von statischen
// Methoden
SomeClass::someExample();

// vgl. Java und Object, eine Basis-Klasse
// -> Objekte können frei modifiziert werden
$other = new stdClass();
$other->moreStuff = 123;