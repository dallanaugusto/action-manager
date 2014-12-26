<?php

namespace TestAction\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Dallan\Action\Action;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $action = new Action();
        return new ViewModel();
    }


}

