<?php

namespace TestAction\Controller;

use TestAction\Model\DepartmentDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DepartmentController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel(array(
            'departments' => DepartmentDao::getAll(),
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
        return new ViewModel();
    }

    public function viewAction()
    {
        return new ViewModel();
    }


}

