<?php

namespace Application\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\TinEyeProxyController;
use Application\Service\TinEyeService;

class TinEyeProxyControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sl = $serviceLocator->getServiceLocator();
        $controller = new TinEyeProxyController(new TinEyeService(), $sl->get('config')['tinEye']);
        return $controller;
    }
}