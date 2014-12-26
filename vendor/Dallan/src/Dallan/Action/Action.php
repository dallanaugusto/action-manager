<?php

namespace Dallan\Action;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Action
 *
 * @author dallan
 */
class Action {
    
    private $id;
    private $controller;
    private $name;
    private $fatherId;
    private $variable;
    private $log;
    
    // -- Static functions --
    public static function createAction($controller, $name, Action $father = null) {
        $action = new Action($controller, $name, $father);
        $action->init();
        return $action;
    }
    
    public static function getAction($id) 
    {
        if (isset($_SESSION["action"][$id]))
            return unserialize($_SESSION["action"][$id]);
    }
    
    // -- Contructors --
    private function __construct($controller, $name, Action $father = null)
    {
        $this->controller = $controller;
        $this->name = $name;
        $this->fatherId = $father? $father->getId(): null;
        $this->variable = array();
        $this->log = "";
    }
    
    // -- Getters --
    public function getId() 
    {
        return $this->id;
    }
    
    public function getController() 
    {
        return $this->controller;
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function getFatherId() {
        return $this->fatherId;
    }
    
    public function getFather() 
    {
        return $this->fatherId? Action::getAction($this->fatherId): null;
    }
    
    public function getVariable($label) 
    {
        return isset($this->variable[$label])? $this->variable[$label]: null;
    }
    
    public function getLog() 
    {
        return $this->log;
    }
    
    // -- Setters --
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function setVariable($label, $value) {
        $this->variable[$label] = $value;
        $this->addLog("Action ".$this->controller."->".$this->name."->setVariable($label)<br>");
        $this->serializeMe();
    }
    
    public function deleteVariable($label) {
        if (isset($this->variable[$label]))
            unset($this->variable[$label]);
        $this->addLog("Action ".$this->controller."->".$this->name."->deleteVariable($label)<br>");
        $this->serializeMe();
    }
    
    public function addLog($string) 
    {
        $this->log = $this->log.$string;
        $this->serializeMe();
        if ($this->fatherId)
            $this->getFather()->addLog($string);
    }
    
    // -- Session controllers --
    public function init() 
    {
        if (!isset($_SESSION["actionIdCounter"])) {
            $_SESSION["actionIdCounter"] = 1;
            $_SESSION["action"] = array();
        }
        $this->id = $_SESSION["actionIdCounter"]++;
        $this->serializeMe();
        $this->addLog("Action ".$this->controller."->".$this->name."->init<br>");
    }
    
    public function finish($subAction = null, $subActionValue = null) 
    {
        $this->addLog("Action ".$this->controller."->".$this->name."->finish<br>");
        $this->serializeMe();
        if ($this->fatherId) 
            $this->callFather($subAction,$subActionValue);
        else
            $this->callMe();
    }
    
    public function serializeMe() {
        $_SESSION["action"][$this->id] = serialize($this);
    }
    
    // -- Redirect functions --
    public function callMe($subAction = null, $subActionValue = null) 
    {
        $this->serializeMe();
        $subActionString = $subAction?
            "&subAction=".$subAction: "";
        $subActionValueString = $subActionValue?
            "&subActionValue=".$subActionValue: "";
        header(
            "Location: ?actionId=".$this->id.$subActionString.$subActionValueString
        );
    }
    
    public function callFather($subAction = null, $subActionValue = null) 
    {
        $this->serializeMe();
        if ($this->fatherId)
            $this->getFather()->callMe($subAction,$subActionValue);
    }
    
    // -- Output functions --
    public function printMe() {
        echo 
            "ID: ".$this->getId()." / Controller: ".$this->getController().
            " / Name: ".$this->getName()." / Father: ".$this->fatherId."<br>";
    }
    
    public static function printActions() {
        foreach ($_SESSION["action"] as $act) {
            $action = unserialize($act);
            $action->printMe();
        }
    }
    
    
}
