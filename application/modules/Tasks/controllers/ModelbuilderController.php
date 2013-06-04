<?php
/**
 * Controller that uses Doctrine to physically build ExtJs models. Extensive use
 * of the config so if you have any issues, look there first. Make sure the folder
 * /f2/Library/Esquire/Templates/Javascript/output exists - this is where the new
 * .js models get written. This can be changed in the config (javascript.path.models)
 * but make sure the system can write to the folder specified.
 *
 * @author Michael Locke
 * @jira NCRP-3
 */
class Tasks_ModelbuilderController extends Zend_Controller_Action
{
    public function init()
	{
		$contextSwitcher = $this->_helper->getHelper('contextSwitch');
		$contextSwitcher->addActionContext('get', 'json');
		$contextSwitcher->addActionContext('put', 'json');
		$contextSwitcher->addActionContext('post', 'json');
		$contextSwitcher->addActionContext('delete', 'json');
		$contextSwitcher->initContext();
	}

    public function indexAction()
    {

    }

    /**
     * Primary controller method. With call other methods during the process
     * of creating JavaScript models from Doctrine models.
     *
     * @access public
     * @param void Uses the Zend _getAllParams() method to read the request.
     * @return boolean True on success.
     */
    public function buildAction()
    {
        $this->_config = Esquire_Config_Factory::getApplicationConfig();
        $this->_logger = Esquire_Log_Factory::getLogger($this->_config, 'Tasks');
        
        $this->_manager = Doctrine_Manager::getInstance();
        $conn = Esquire_Db_Connection_Factory::getConnection(
                'connection_browngallo',
                $this->_manager,
                $this->_config
            );

        $javascriptModelPath = $this->_config->javascript->path->models;
        $params = $this->_getAllParams();
        
        /**
         * If the parameter 'all' is set to true, it doesn't matter what
         * the value of the 'database' parameter is; we are going to loop over
         * Solaria, Intranet, Main and SolariaCentral and create JavaScript models
         * from the database tables.
         *
         * If the parameter 'all is set to false, we just look at the 'database'
         * parameter and create JavaScript models from that database only.
         */
        if ($params['database'] == 'all') {
            $database = 'all';
        } else {
            $database = $params['database'];
        }

        /**
         * Doing only one database.
         * @todo Allow "all" to be passed and loop over all three databases.
         */
        if ($database !== 'all') {
            $pathToDoctrine = $this->_config->doctrine->path->$database;
            $classPrefix = $this->_config->doctrine->class_prefix->$database;
        }
        
        $dirList = $this->_readDirectory($pathToDoctrine);
        
        /**
         * $dirList is a multi-dimensional array that includes the
         * directory list of the sub-folders such as "auto_generated_files"
         * and "base". Let's remove those sub-arrays. We will also
         * format the file name into the actual class name. This requires
         * pre-pending the name with $classPrefix and removing
         * the ".php" from the file name.
         *
         * We also do not want to include the Table classes. That is
         * handled below.
         */
        $skippedClasses = array('Models_Solaria_X_AcclaimOwnership');

        $flatArray = array();
        $needle = 'Table';
        foreach ($dirList as $file) {
            if (!is_array($file)) {
                $className = null; // re-initialize $className everytime through.
                if (strpos($file, $needle) === false) { // Not a table class file
                    $fileName = str_replace(".php", '', $file);
                    $fullName = $classPrefix . $fileName;
                    if (!in_array($fullName, $skippedClasses)) {
                        $flatArray[] = $fullName;
                    }
                }
            }
        }
        
        /**
         * Remove non-exposed classes and get column data. This call also
         * creates the class attribute $this->_exposedClassesFullName which
         * will be set in the writer and used to filter relationships to only
         * exposed tables.
         */
        $exposedClasses = $this->_removeUnexposedClasses($flatArray);

        /**
         * Get a writer class. This class will do the actual model file creation work.
         */
        $currentClassWriter = $this->_config->doctrine->current_class_writer;
        $writer = Esquire_Writer_Factory::getInstance($this->_config, $currentClassWriter);
        $writer->setExposedClasses($this->_exposedClassesFullName);
        
        foreach ($exposedClasses as $className => $columns) {
        	
            /**
             * We use $currentClassWriter to get the path to where the models will live.
             */
            $fullPathName = $this->_config->$currentClassWriter->path->models . '/' . $className . '.js';

            /**
             * This method call does the actual javascript file creation.
             */
            $result = $writer->write($className, $columns);
            
            if ($result !== true) {
                $this->_logger->log('ERROR CREATING: ' . $className . ' :: ' . $e->getMessage(), Zend_Log::ERR);
                $this->_logger->log('ERROR TRACE: ' . $className . ' :: ' . $e->getTraceAsString(), Zend_Log::ERR);
            }
            
        }
    }

    /**
     * If a doctrine model has no fields with the exposed attribute set to true, then
     * the class is skipped and no JavaScript class is created. If we encounter a class
     * with the exposed attribute set to true, we gather all the table information we'll
     * need. Return an array indexed by $className (table name).
     *
     * @access private
     * @param array $flatArray  Flat array of Doctrine class names for the given database.
     * @return array $exposedClasses
     */
    private function _removeUnexposedClasses($flatArray)
    {
        /**
         * Get the Doctrine table and read the column names.
         */
        $exposedClasses = array();
        $exposedClassesFullName = array();
        $modelOnlyExposedColumns = $this->_config->doctrine->model_only_exposed_columns;
        foreach ($flatArray as $class) {
            $table = null;
            $columns = null;

            $table = Doctrine_Core::getTable($class);
            $tableName = $table->getTableName();
            $columns = $table->getColumns();
            foreach ($columns as $key => $column) {
            	$key = ucfirst($key);
                foreach ($column as $attribute => $value) {
                	if ($modelOnlyExposedColumns == true) {
	                    if ($attribute == 'exposed' && $value == true) {
	                        $exposedClasses[$tableName]['columns'][$key] = $column;
	                        $exposedClassesFullName[] = $class;
	                    }
                	} else { // We do all columns.
                		$exposedClasses[$tableName]['columns'][$key] = $column;
                		$exposedClassesFullName[] = $class;
                	}
                }
            }
            
            /**
             * Add the relationships to the array
             */
            try {
            	$exposedClasses[$tableName]['relations'] = $this->_addRelationshipInfo($table);
            } catch (Exception $e) {
            	$this->_logger->log($e->getMessage(), Zend_Log::DEBUG);
            	$this->_logger->log($e->getTraceAsString(), Zend_Log::DEBUG);
            }
           
        }
        $this->_exposedClassesFullName = array_unique($exposedClassesFullName);
        return $exposedClasses;
    }

    /**
     * Add relationship information to the array and return it.
     *
     * @access private
     * @param Doctrine_Table $table
     * @return array $tmpArray
     */
    private function _addRelationshipInfo(Doctrine_Table $table)
    {
        $tmpArray = array();
        $relations = $table->getRelations();
        
        foreach ($relations as $relKey => $relation) {
             $tmpArray[] = $relation->getClass() . '::' . $relation->getAlias() . '::' . $relation->getType();
        }
        return $tmpArray;
    }

    /**
     * Read the repository.hot_folder directory.
     *
     * @param string $dir
     * @return array $listDir
     */
    private function _readDirectory($dir)
    {
        $listDir = array();
        if ($handler = opendir($dir)) {
            while (($sub = readdir($handler)) !== FALSE) {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") {
                    if (is_file($dir . "/" . $sub)) {
                        $listDir[] = $sub;
                    } elseif (is_dir($dir . "/" . $sub)) {
                        $listDir[$sub] = $this->_readDirectory($dir . "/" .$sub);
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }

    

}