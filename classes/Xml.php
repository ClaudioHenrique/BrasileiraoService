<?php

class Xml {

    private $xml;
    private $tab = 1;

    public function __construct($version = '1.0', $encode = 'ISO-8859-1') {
        $this->xml .= "<?xml version = '$version' encoding = '$encode' ?>";
    }

    public function openTag($name) {
        $this->addTab();
        $this->xml .= "<$name>\n";
        $this->tab++;
    }

    public function closeTag($name) {
        $this->tab--;
        $this->addTab();
        $this->xml .= "</$name>\n";
    }

    public function setValue($value) {
        $this->xml .= "$value \n";
    }

    private function addTab() {
        for ($i = 0; $i < $this->tab; $i++) {
            $this->xml .= "\t";
        }
    }

    public function addTag($name, $value) {
        $this->xml .= "<$name> $value </$name> \n";
    }

    public function __toString() {
        return $this->xml;
    }

}

?>