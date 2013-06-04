<?php

class AD_UserController extends Zend_Controller_Action
{
    /**
     * Update all personnel records with Active Directory data.  
     * The records must already be linked to AD (see linkallpersonnelAction)
     */
    public function syncallpersonnelAction()
    {
        $this->_helper->layout()->setLayout('plain');

        $config = Esquire_Config_Factory::getApplicationConfig();

        $logger = Esquire_Log_Factory::getLogger($config, 'AD');

        $personnelTable = Doctrine_Core::getTable('Models_Main_Personnel');
        $personnel = $personnelTable->getUsersForAdSyncQuery()
                   ->execute();
        $logger->log('Found ' . $personnel->count() . ' personnel records', Zend_Log::INFO);
        $personnelTable->syncWithAd($logger, $config, $personnel);
        $personnel->save();

        $this->view->log = $logger;
    }

    /**
     * Find personnel records who are missing a link to Active Directory 
     * and try to update them.
     */
    public function linkallpersonnelAction()
    {
        $this->_helper->layout()->setLayout('plain');

        $config = Esquire_Config_Factory::getApplicationConfig();

        $logger = Esquire_Log_Factory::getLogger($config, 'AD');

        $personnelTable = Doctrine_Core::getTable('Models_Main_Personnel');
        $personnel = $personnelTable->getUsersForAdLinkQuery()
                   ->execute();
        $logger->log('Found ' . $personnel->count() . ' personnel records', Zend_Log::INFO);
        $personnelTable->linkWithAd($logger, $config, $personnel);
        $personnel->save();
    }

    /**
     * Add a user defined link between Active Directory and personnel
     */
    public function addlinkAction()
    {
        $this->_helper->layout()->setLayout('plain');

        try {
            $idNumber = $this->_getParam('ID_number');
            $adUsername = $this->_getParam('ad_username');
            $sync = ($this->_getParam('sync_with_ad') == 'on') ? true : false;

            if (empty($idNumber)) {
                throw new Esquire_Exception_Framework('No ID number given');
            }
            if (empty($adUsername)) {
                throw new Esquire_Exception_Framework('No AD username given');
            }

            $user = Doctrine_Core::getTable('Models_Main_Personnel')->findByID_number($idNumber)->getFirst();
            if (! $user instanceof Models_Main_Personnel) {
                throw new Esquire_Exception_Framework('No user found');
            }

            $user->ad_username = $adUsername;
            $user->sync_with_ad = $sync;
            $user->save();

            $this->view->success = true;

        } catch (Esquire_Exception_Framework $e) {
            $this->view->success = false;
            $this->view->exception = $e;
        }
    }

    /**
     * Confirm whether a given Active Directory username can be found and 
     * matches a given personnel record
     */
    public function checklinkAction()
    {
        $this->_helper->layout()->setLayout('plain');

        try {
            $idNumber = $this->_getParam('ID_number');
            $adUsername = $this->_getParam('ad_username');

            if (empty($idNumber)) {
                throw new Esquire_Exception_Framework('No ID number given');
            }
            if (empty($adUsername)) {
                throw new Esquire_Exception_Framework('No AD username given');
            }

            $user = Doctrine_Core::getTable('Models_Main_Personnel')->findByID_number($idNumber)->getFirst();
            if (! $user instanceof Models_Main_Personnel) {
                throw new Esquire_Exception_Framework('No user found');
            }
            /**
             * Temporarily add an "ad_username" value to the personnel record. 
             * This won't be saved here.
             */
            $user->ad_username = $adUsername;

            $config = Esquire_Config_Factory::getApplicationConfig();
            $logger = Esquire_Log_Factory::getLogger($config, 'AD');

            $ldap = new Esquire_Ldap_Connector($config, $logger);
            $ldapUser = $ldap->getUserEntry(
                $user,
                new Esquire_Ldap_Locator_Strict()
            );

            if ($ldapUser === false) {
                throw new Esquire_Exception_Framework('No Active Directory user found for the given username');
            }

            $this->view->success = true;

        } catch (Esquire_Exception_Framework $e) {
            $this->view->success = false;
            $this->view->exception = $e;
        }
    }
}

