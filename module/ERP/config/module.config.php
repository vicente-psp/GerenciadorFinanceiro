<?php
namespace ERP;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' =>array(
                    'route' => '/ERP',
                    'defaults' => array(
                        'controller' => 'ERP\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            
            'application' => array(
                'type' => 'Literal',
                'options' => array(
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
    ),
//    'service_manager' => array(
//        'factories' => array(
//            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory'
//        )
//    ),
//    'translator' => array(
//        'locale' => 'en_US',
//        'translation_file_patterns' => array(
//            array(
//                'type'      => 'gettext',
//                'base_dir'  => __DIR__ . '/../language',
//                'pattern'   => '%s.mo'
//            )
//        )
//    ),
    'controllers' => array(
        'invokables' => array(
            'ERP\Controller\Index' => 'ERP\Controller\IndexController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason'  => true,
        'display_exceptions'        => true,
        'doctype'                   => 'HTML5',
        'not_found_template'        => 'error/404',
        'exception_template'        => 'error/index',
        'template_map' => array(
            'layout/layout'             => __DIR__ . '../../Application/view/layout/layout.phtml',
//            'application/index/index'   => __DIR__ . '../../Application/view/application/index/index.phtml',
            'error/404'                 => __DIR__ . '../../Application/view/error/404.phtml',
            'error/index'                 => __DIR__ . '../../Application/view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
    
    
    
);