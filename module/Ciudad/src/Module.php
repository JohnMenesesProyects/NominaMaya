<?php

namespace Ciudad;


use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Sql; /*se agrego esta libreria*/
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;



class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\CiudadTable::class => function($container) {
                    $tableGateway = $container->get(Model\CiudadTableGateway::class);
                    return new Model\CiudadTable($tableGateway);
                },
                Model\CiudadTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Ciudad());
                    return new TableGateway('ciudad', $dbAdapter, null, $resultSetPrototype);
                },          /*Aqui va el nombre de la tabla de la base de datos*/
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CiudadController::class => function($container) {
                    return new Controller\CiudadController(
                        $container->get(Model\CiudadTable::class)
                    );
                },
            ],
        ];
    }
}



