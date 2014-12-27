<?php

namespace TestAction\Controller;

use Dallan\Action\Action;
use TestAction\Model\PersonDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel(array(
            'people' => PersonDao::getAll(),
        ));
    }

    public function deleteAction()
    {
        return new ViewModel();
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function getAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        // get the persistent action or create a new one
        $actionId = \filter_input(\INPUT_GET, 'actionId');
        $action = $actionId? 
            Action::getAction($actionId): Action::createAction('person','new');
        // get the variables if they were already  defined
        $department = Action::getVariable('department');
        $personFields = Action::getVariable('personFields');
        // goes to the view
        return new ViewModel(array(
            'action' => $action, 'department' => $department, 
            'personFields' => $personFields
        ));
    }

    public function viewAction()
    {
        return new ViewModel();
    }


}

