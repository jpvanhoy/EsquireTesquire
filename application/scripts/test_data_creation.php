<?php

require_once realpath(dirname(__FILE__) . '/../../library/Esquire/Application/External.php');

$application = new Esquire_Application_External();
$application->run();

$setup = new Esquire_Db_Setup_SQLite(Esquire_Config_Factory::getApplicationConfig());

$setup->createAllDatabases();
echo "\nDatabase creation is complete\n\n";

exit();
