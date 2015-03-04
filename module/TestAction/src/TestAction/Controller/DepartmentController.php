<?php

namespace TestAction\Controller;

use Dallan\Mvc\Controller\AbstractActionController;
use TestAction\Model\DepartmentDao;

class DepartmentController extends AbstractActionController
{

    public function indexAction()
    {
        
    }

    public function deleteAction()
    {
        
    }

    public function editAction()
    {
        
    }

    public function getAction()
    {
        // verify if it wants to return
        $this->tryToReturnToMyFatherAction();     
        
        // goes to the view
        return array(
            'myAction' => $this->getMyAction(), 'myFather' => $this->getMyFatherAction(),
            'departments' => DepartmentDao::getAll(),
        );   
    }

    public function newAction()
    {
        
    }

    public function viewAction()
    {
        
    }


}

