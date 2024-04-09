<?php 
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'database'=>[
                'type' => Segment::class,
                'options' =>[
                    'route' => '/adapter[/:action]',
                    'defaults' => [
                        'controller' => Controller\AdapterController::class,
                        'action' => 'index',
                    ],
                    'constraints'=>[
                        'action' => '[a-zA-Z0-9_-]*'
                    ]
                    ],
            ]
        ]
    ]
]