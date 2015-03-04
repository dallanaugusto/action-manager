<?php

namespace Dallan\Mvc\Model;

use Zend\Session\Container;

class ActionDao {
    
    private static $instance;
    private $sessionContainer;
    
    // ---- Construtores e getter de instância
    
    public function __construct($sessionContainer)
    {
        $this->sessionContainer = $sessionContainer;
    }
    
    public static function getInstance()
    {
        if (!self::$instance) {
            $sessionContainer = new Container('actionDao');
            if (!isset($sessionContainer->idCounter)) {
                $sessionContainer->idCounter = 1;
                $sessionContainer->actions = array();
            }
            self::$instance = new ActionDao($sessionContainer);
        }
        return self::$instance;
    }
    
    
    // ---- Getters
    
    public function getIdCounter()
    {
        return $this->sessionContainer->idCounter;
    }
    
    public function getActions()
    {
        return $this->sessionContainer->actions;
    }
    
    public function getAction($id)
    {
        return isset($this->sessionContainer->actions[$id])?
            $this->sessionContainer->actions[$id]: null;
    }
    
    public function isActionId($id)
    {
        return isset($this->sessionContainer->actions[$id]);
    }
    
    public function getActionVariable($actionId, $variableName)
    {
        return $this->getAction($actionId)->getVariable($variableName);
    }
    
    
    // ---- Setters
    
    public function setActionVariable($actionId, $variableName, $variableValue)
    {
        $this->sessionContainer->actions[$actionId]->setVariable($variableName, $variableValue);
    }
    
    public function setActionReturnVariable($actionId, $variableValue)
    {
        $action = $this->getAction($actionId);        
        $father = $this->getAction($action->getFatherId());
        if ($father) {            
            $variableName = $this->sessionContainer->actions[$actionId]->getReturnVar();  
            $this->setActionVariable($father->getId(), $variableName, $variableValue);
        }
    }
    
    
    // ---- Other actions
    
    public function createAction($route, $controller, $name, $fatherId = null, $returnVar = null)
    {
        $father = $this->getAction($fatherId)? $fatherId: 0;
        
        $actionId = $this->sessionContainer->idCounter;
        $action = $this->sessionContainer->actions[$actionId] = new Action(
            $actionId, $route, $controller, $name, $father, $returnVar
        );
        $this->sessionContainer->idCounter++;
        return $action;
    }
    
    public function updateAction($actionId)
    {
        $action = $this->getAction($actionId);
        if ($action) {
            $this->sessionContainer->actions[$actionId] = $action;
            return true;
        }
        return false;
    }
    
    
}
