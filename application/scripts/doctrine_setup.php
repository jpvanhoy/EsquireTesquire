<?php

require_once realpath(dirname(__FILE__) . '/../../library/Esquire/Application/External.php');
$application = new Esquire_Application_External();
$application->run();

$connection = Esquire_Db_Connection_Factory::getConnection(
    'main', 
    Doctrine_Manager::getInstance(), 
    Esquire_Config_Factory::getApplicationConfig()
);

Doctrine_Core::generateModelsFromDb(
    APPLICATION_PATH . '/models/Main/auto_generated_files',
    array('main'),
    array(
        'generateTableClasses' => true,
        'generateBaseClasses' => true,
        'classPrefix' => 'Models_Main_',
        'classPrefixFiles' => false,
        'baseClassesDirectory' => 'Base',
        'baseClassPrefix' => 'Base_'
    )
);

$connection = Esquire_Db_Connection_Factory::getConnection(
    'worksheets', 
    Doctrine_Manager::getInstance(), 
    Esquire_Config_Factory::getApplicationConfig()
);

Doctrine_Core::generateModelsFromDb(
    APPLICATION_PATH . '/models/Worksheets/auto_generated_files',
    array('worksheets'),
    array(
        'generateTableClasses' => true,
        'generateBaseClasses' => true,
        'classPrefix' => 'Models_Worksheets_',
        'classPrefixFiles' => false,
        'baseClassesDirectory' => 'Base',
        'baseClassPrefix' => 'Base_'
    )
);

$connection = Esquire_Db_Connection_Factory::getConnection(
    'intranet', 
    Doctrine_Manager::getInstance(), 
    Esquire_Config_Factory::getApplicationConfig()
);

Doctrine_Core::generateModelsFromDb(
    APPLICATION_PATH . '/models/Intranet/auto_generated_files',
    array('intranet'),
    array(
        'generateTableClasses' => true,
        'generateBaseClasses' => true,
        'classPrefix' => 'Models_Intranet_',
        'classPrefixFiles' => false,
        'baseClassesDirectory' => 'Base',
        'baseClassPrefix' => 'Base_'
    )
);

$connection = Esquire_Db_Connection_Factory::getConnection(
    'connection_tk',
    Doctrine_Manager::getInstance(), 
    Esquire_Config_Factory::getApplicationConfig()
);

Doctrine_Core::generateModelsFromDb(
    APPLICATION_PATH . '/models/Solaria/auto_generated_files',
    array('connection_tk'),
    array(
        'generateTableClasses' => true,
        'generateBaseClasses' => true,
        'classPrefix' => 'Models_Solaria_',
        'classPrefixFiles' => false,
        'baseClassesDirectory' => 'Base',
		'baseClassPrefix' => 'Base_',
		'skipConnectionBinding' => true
    )
);
