<?php
namespace ERP;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' =>array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'ERP\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            
            'application' => array(
                'type' => 'Literal',
                'option' => array(
                    'route' => '/ERP',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ERP\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            )
                        )
                    )
                )
                
                
            )
            
        )
    )
    
    
    
);