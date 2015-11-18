<?php
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage;

return [
    'annotation_forms' => [
        
    ],
    'cmsimage' => [
        
    ],
    'controllers' => [
        'invokables' => [
            'CmsImage\Controller\Admin' => 'CmsImage\Mvc\Controller\AdminController',
        ],
    ],
    'form_elements' => [
        'factories' => [
            'ImageUpload' => 'CmsImage\Factory\Form\Element\ImageUploadElementFactory',
        ],
        'invokables' => [
            'Image' => 'CmsImage\Mapping\ImageInterface',
        ],
    ],
    'listeners' => [
        'CmsImage\Listener\ImageUploadListener' => 'CmsImage\Listener\ImageUploadListener',
    ],
    'router' => [
        'routes' => [
            'cms-admin' => [
                'child_routes' => [
                    'image' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/image[/:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z\-]*',
                                'action' => '[a-zA-Z\-]*',
                                'id' => '[a-zA-Z0-9\-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'CmsImage\Controller',
                                'controller' => 'Admin',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'CmsImage\Options\ModuleOptions' => 'CmsImage\Options\ModuleOptionsInterface',
        ],
        'factories' => [
            'CmsImage\Options\ModuleOptionsInterface' => 'CmsImage\Factory\ModuleOptionsFactory',
        ],
        'invokables' => [
            'CmsImage\Listener\ImageUploadListener' => 'CmsImage\Listener\ImageUploadListener',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
                'text_domain' => __NAMESPACE__,
            ],
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'cmsImage' => 'CmsImage\View\Helper\Image',
        ],
        'factories' => [
            'CmsImage\View\Helper\Image' => 'CmsImage\Factory\View\Helper\ImageHelperFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
];
