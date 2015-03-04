<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Dallan\Controller\PersistentAction' => 'Dallan\Controller\PersistentActionController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'dallan' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/dallan[/[:controller[/[:action[/]]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Dallan\Controller',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'dallan' => __DIR__ . '/../view',
        ),
    ),
);