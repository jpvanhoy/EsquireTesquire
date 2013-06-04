<?php

/**
 * Models_Main_PersonnelTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Models_Main_PersonnelTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object Models_Main_PersonnelTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Models_Main_Personnel');
    }

    public function getBaseQueryForActiveUsers()
    {
        $query = Doctrine_Query::create();
        $query->from('Models_Main_Personnel');
        $query->andWhere('active = ?', 'yes');
        $query->andWhereNotIn('departmentid', array(14, 15));
        return $query;
    }

    public function getUsersForAdSyncQuery()
    {
        $query = $this->getBaseQueryForActiveUsers();
        $query->andWhere('ad_username IS NOT NULL');
        $query->andWhere('sync_with_ad = 1');
        return $query;
    }

    public function getUsersForAdLinkQuery()
    {
        $query = $this->getBaseQueryForActiveUsers();
        $query->andWhere('ad_username IS NULL');
        return $query;
    }

    /**
     * Sync given records with Active Directory
     *
     * @param Zend_Log $logger
     * @param Zend_Config_Ini $config
     * @param Doctrine_Collection $personnelCollection
     * @return void
     */
    public function syncWithAd(Zend_Log $logger, Zend_Config_Ini $config, Doctrine_Collection $personnelCollection)
    {
        $ldap = new Esquire_Ldap_Connector($config, $logger);
        $locator = new Esquire_Ldap_Locator_Strict();
        foreach ($personnelCollection as $personnel) {
            $logger->log('Attempting to sync ' . $personnel->username, Zend_Log::INFO);
            $ldapUser = $ldap->getUserEntry($personnel, $locator);

            if (! $ldapUser instanceof Esquire_Ldap_User) {
                $logger->log('No LDAP user found for ' . $personnel->username, Zend_Log::INFO);
                continue;
            }

            $logger->log('Match found for ' . $personnel->username, Zend_Log::INFO);

            /**
             * Update:
             * - extension
             * - email address (@esquiresolutions preferred)
             * - DID
             *
             * Existing main.personnel values will be backed up in the 
             * backup_extension, backup_email_address, etc fields
             */
            if (preg_match('/\d{4,5}/', $ldapUser->telephonenumber)) {
                $logger->log(
                    'Updating extension from ' . $personnel->extension
                    . ' to ' . $ldapUser->telephonenumber,
                    Zend_Log::INFO
                );
                if (empty($personnel->backup_extension)) {
                    $personnel->backup_extension = $personnel->extension;
                }
                $personnel->extension = $ldapUser->telephonenumber;
            }

            $did = preg_replace('/\D/', '', $ldapUser->homephone);
            if (preg_match('/\d{10}/', $did)) {
                $logger->log(
                    'Updating DID from ' . $personnel->DID
                    . ' to ' . $did,
                    Zend_Log::INFO
                );
                if (empty($personnel->backup_DID)) {
                    $personnel->backup_DID = $personnel->DID;
                }
                $personnel->DID = $did;
            }

            /**
             * Update email address
             * The current logic is:
             *     - If a "preferred_email_address" exists it wins
             *     - else, if an @esquiresolutions.com address exists it wins
             *     - else, if an @alexandergalloholdings.com address exists it wins
             *     - else, the first email address present wins
             */
            if (count($ldapUser->email_addresses) > 0) {
                $bestAddresses = array();
                $bestAddress = current($ldapUser->email_addresses);

                $preferred = $ldapUser->preferred_email_address;
                if (!empty($preferred)) {
                    $bestAddress = $ldapUser->preferred_email_address;
                } else {
                    foreach ($ldapUser->email_addresses as $address) {
                        if (strpos($address, '@esquiresolutions.com') !== false) {
                            $bestAddresses[0] = $address;
                        }
                        if (strpos($address, '@alexandergalloholdings.com') !== false) {
                            $bestAddresses[1] = $address;
                        }
                    }
                    
                    foreach ($bestAddresses as $address) {
                        if (!empty($address)) {
                            $bestAddress = $address;
                            break;
                        }
                    }
                }

                $logger->log(
                    'Updating email from ' . $personnel->email
                    . ' to ' . $bestAddress,
                    Zend_Log::INFO
                );
                if (empty($personnel->backup_email)) {
                    $personnel->backup_email = $personnel->email;
                }
                $personnel->email = $bestAddress;
            }
        }
    }

    /**
     * Link the given records with Active Directory
     *
     * @param Zend_Log $logger
     * @param Zend_Config_Ini $config
     * @param Doctrine_Collection $personnelCollection
     * @return void
     */
    public function linkWithAd(Zend_Log $logger, Zend_Config_Ini $config, Doctrine_Collection $personnelCollection)
    {
        $ldap = new Esquire_Ldap_Connector($config, $logger);
        $locator = new Esquire_Ldap_Locator_Fuzzy();
        foreach ($personnelCollection as $personnel) {
            $logger->log('', Zend_Log::INFO);
            $logger->log('Attempting to link ' . $personnel->username, Zend_Log::INFO);
            $ldapUser = $ldap->getUserEntry($personnel, $locator);

            if (! $ldapUser instanceof Esquire_Ldap_User) {
                $logger->log('No LDAP user found for ' . $personnel->username, Zend_Log::INFO);
                continue;
            }

            $logger->log('Match found for ' . $personnel->username, Zend_Log::INFO);
            $personnel->ad_username = $ldapUser->ad_username;
        }
    }
}
