<?php

namespace Trafegus;

return array(
    'controllers' => array(
        'invokables' => array(
            'trafegus/motorista' => 'Trafegus\Controller\MotoristaController',
            'trafegus/veiculo' => 'Trafegus\Controller\VeiculoController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'motorista' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/motorista[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'trafegus/motorista',
                        'action' => 'index',
                    ),
                ),
            ),
            'veiculo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/veiculo[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'trafegus/veiculo',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'trafegus' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);
