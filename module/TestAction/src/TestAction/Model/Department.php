<?php

namespace TestAction\Model;

class Department {
    
    private $id;
    private $name;
    
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }  
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    
}
