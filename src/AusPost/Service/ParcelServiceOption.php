<?php
namespace Tolerable\AusPost\Service;

class ParcelServiceOption implements \Countable {
    private $code;
    
    private $name;
    
    private $subOptions = array();
    
    public function __construct($code, $name) {
        $this->setCode($code)
             ->setName($name);
    }
    
    public function setCode($code) {
        $this->code = (string) $code;
        return $this;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    public function setName($name) {
        $this->name = (string) $name;
        return $this;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function __toString() {
        return $this->getName();
    }
    
    public function addSubOption(ParcelServiceSubOption $subOption) {
        $this->subOptions[$subOption->getCode()] = $subOption;
        return $this;
    }
    
    public function hasSubOption($code) {
        return \array_key_exists($code, $this->subOptions);
    }
    
    public function getSubOptions() {
        return $this->subOptions;
    }
    
    public function getSubOption($code) {
        if ($this->hasSubOption($code)) {
            return $this->subOptions[$code];
        }
        return null;
    }

    public function count() {
        return \count($this->subOptions);
    }
}
