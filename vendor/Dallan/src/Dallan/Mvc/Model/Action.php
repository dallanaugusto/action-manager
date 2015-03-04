<?php

namespace Dallan\Mvc\Model;

class Action {
    
    private $id;
    private $route;
    private $controller;
    private $name;
    private $fatherId;
    private $returnVar;
    private $variables;
    
    public function __construct($id, $route, $controller, $name, $fatherId = null, $returnVar = null) 
    {
        $this->id = $id;
        $this->route = $route;
        $this->controller = $controller;
        $this->name = $name;
        $this->fatherId = $fatherId;
        $this->returnVar = $returnVar;
        $this->variables = array();
    }

    
    public function getId() 
    {
        return $this->id;
    }

    public function getRoute() 
    {
        return $this->route;
    }

    public function getController() 
    {
        return $this->controller;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getFatherId() 
    {
        return $this->fatherId;
    }

    public function getReturnVar() 
    {
        return $this->returnVar;
    }    
    
    public function getVariables() 
    {
        return $this->variables;
    } 
    
    public function getVariable($name) 
    {
        return isset($this->variables[$name])? $this->variables[$name]: null;
    }
    
    
    // ---- Setters
    
    public function setVariable($name, $value) 
    {
        $this->variables[$name] = $value;
    }

    
}
