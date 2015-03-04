<?php

namespace TestAction\Controller;

use Dallan\Mvc\Controller\AbstractActionController;
use TestAction\Model\DepartmentDao;
use TestAction\Model\PersonDao;

class PersonController extends AbstractActionController
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
        
    }

    public function newAction()
    {
        // verify if it wants to return
        $this->tryToReturnToMyFatherAction();        
        
        // test if it's complete
        $departmentId = $this->getVariableInMyAction('department');
        $department = $departmentId? 
            DepartmentDao::getDepartment($departmentId): null;
        $personFields = $this->getVariableInMyAction('personFields');
        $complete = $department && $personFields;
        
        // goes to the view
        return array(
            'myAction' => $this->getMyAction(), 'myFather' => $this->getMyFatherAction(),
            'department' => $department, 'personFields' => $personFields,
            'complete' => $complete
        );
    }

    public function viewAction()
    {
        
    }


}

