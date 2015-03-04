<?php

namespace Dallan\Mvc\Controller;

use Dallan\Mvc\Model\Action;
use Dallan\Mvc\Model\ActionDao;

abstract class AbstractActionController extends \Zend\Mvc\Controller\AbstractActionController
{
    
    private $myActionDao;
    private $myAction;
    private $myFatherAction;
    
    // ---- onDispatch
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) 
    {
        $actionId = $this->request->getQuery('actionId');
        
        $this->myActionDao = ActionDao::getInstance();
        $this->myAction = $this->myActionDao->getAction($actionId);
        $this->myFatherAction = $this->myAction? 
            $this->myActionDao->getAction($this->myAction->getFatherId()): null;
        
        if (!$actionId) {
            $fatherId = $this->request->getQuery('father');
            $returnVar = $this->request->getQuery('returnVar');

            $sm = $this->getPluginManager()->getServiceLocator();
            $routeMatch = $sm->get('Application')->getMvcEvent()->getRouteMatch();
            $route = $routeMatch->getMatchedRouteName();

            // treating controller
            $controller = $this->getEvent()->getRouteMatch()->getParam('controller', 'index');
            $controller = lcfirst(array_pop(explode('\\', $controller)));
            for ($i = 0; $i < strlen($controller); $i++)
                if (ctype_upper($controller[$i].'')) {
                    $controller = str_replace(''.$controller[$i], '-'.$controller[$i], $controller);
                    $i++;
                }
            $controller = strtolower($controller);

            $actionName = $this->getEvent()->getRouteMatch()->getParam('action', 'index');

            // ---- 
            $this->myAction = $this->myActionDao->createAction($route, $controller, $actionName, $fatherId, $returnVar);
            
            $actionUrl = 
                $this->getRequest()->getBasePath().
                '/'.$this->myAction->getRoute().'/'.$this->myAction->getController().'/'.
                $this->myAction->getName().'?actionId='.$this->myAction->getId();
            
            return $this->redirect()->toUrl($actionUrl);
        }
        
        return parent::onDispatch($e);
    }
    
    
    // ---- Getters
    
    public function getMyAction()
    {
        return $this->myAction;        
    }
    
    public function getMyFatherAction()
    {
        return $this->myFatherAction;
    }
    
    public function getVariableInMyAction($variableName)
    {
        return $this->myActionDao->getActionVariable($this->myAction->getId(), $variableName);
    }
    
    
    // ---- redirects
    
    public function returnToFather()
    {
        $fatherUrl = 
            $this->getRequest()->getBasePath().
            '/'.$this->myFatherAction->getRoute().'/'.$this->myFatherAction->getController().'/'.
            $this->myFatherAction->getName().'?actionId='.$this->myFatherAction->getId();

        return $this->redirect()->toUrl($fatherUrl);
    }
    
    public function tryToReturnToMyFatherAction()
    {
        $return = $this->request->getQuery('return'); 
        if ($return) {
            $this->myActionDao->setActionReturnVariable($this->myAction->getId(), $return);
            $this->returnToFather($this->myAction->getId());
        } 
    }
    
    
}

