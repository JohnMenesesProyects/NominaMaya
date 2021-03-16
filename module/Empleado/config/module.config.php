<?php

namespace Empleado;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;


return [


    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'ciudad' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/ciudad[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CiudadController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'ciudad' => __DIR__ . '/../view',
        ],
    ],
];