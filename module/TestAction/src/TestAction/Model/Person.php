<?php

namespace TestAction\Model;

class Person {
    
    private $id;
    private $name;
    private $department;
    
    public function __construct($id, $name, $department)
    {
        $this->id = $id;
        $this->name = $name;
        $this->department = $department;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDepartment() {
        return $this->department;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDepartment($department) {
        $this->department = $department;
    }

    
}
