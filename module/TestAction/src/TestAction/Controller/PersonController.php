<?php

namespace TestAction\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        return new ViewModel();
    }


}

