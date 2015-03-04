<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'TestAction\Controller\Index' => 'TestAction\Controller\IndexController',
            'TestAction\Controller\Person' => 'TestAction\Controller\PersonController',
            'TestAction\Controller\DepartMent' => 'TestAction\Controller\DepartmentController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'test-action' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/test-action[/[:controller[/[:action[/]]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'TestAction\Controller',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'test-action' => __DIR__ . '/../view',
        ),
    ),
);