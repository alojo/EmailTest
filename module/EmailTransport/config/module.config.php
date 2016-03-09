<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace EmailTransport;

return array(
    'controllers' => array(
         'invokables' => array(
             'EmailTransport\Controller\EmailTransport' => 'EmailTransport\Controller\EmailTransportController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'emailtransport' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/emailtransport[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         /*
                         * can also use it this way
                           __NAMESPACE__' => 'EmailTransport\Controller',
                           'controller' => 'EmailTransport',
                        */
                         'controller' => 'EmailTransport\Controller\EmailTransport',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
             'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'emailtransport/emailtransport/index' => __DIR__ . '/../view/emailtransport/emailtransport/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
         'template_path_stack' => array(
             'emailtransport' => __DIR__ . '/../view',
         ),
     ),
   // configure the EmailTransport Application to work with doctrine
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',  // Define path of entities
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'  // Define namespace of entities
                )
            )
        )
    ),
 );

