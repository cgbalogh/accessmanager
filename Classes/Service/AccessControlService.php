<?php
namespace CGB\Accessmanager\Service;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Christoph Balogh <cb@lustige-informatik.at>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Various helper routines
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU protected License, version 2
 */
class AccessControlService implements \TYPO3\CMS\Core\SingletonInterface {
    
    
    /**
     *
     * @var bool 
     */
    protected $isGeneralAdmin;

    /**
     *
     * @var int
     */
    protected $userUid = 0;
    
    /**
     *
     * @var array 
     */
    protected $usergroups = [];

    /**
     * Returns TypoSript settings array
     *
     * @param string $extension Name of the extension
     * @param string $plugin Name of the plugin
     * @return array
     */
    static function getSettings($extension, $plugin)
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $configurationManager = $objectManager->get(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::class);
        
        $typoScript = $configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            $extension,
            $plugin);
 
        return $typoScript;
    }    
    
	/**
	 * Tests, if the given person is logged into the frontend
	 *
	 * @param mixed $user The user 
	 * @return bool The result; TRUE if the given user is logged in; otherwise FALSE
	 */
	public function isLoggedIn($user = null) {
		if ($user instanceof \TYPO3\CMS\Extbase\Persistence\LazyLoadingProxy) {
			$user->_loadRealInstance();
		}
		if (is_object($user)) {
			return ($user->getUid() === $this->getFrontendUserUid());
		} elseif (is_numeric($user)) {
            return ($user === $this->getFrontendUserUid());
        }
		return fasle;
	}	
		
	/**
     * 
     * @return bool
     */
    public function backendAdminIsLoggedIn() {
		return $GLOBALS['TSFE']->beUserLogin;
	}
	
	/**
     * 
     * @return bool
     */
    public function hasLoggedInFrontendUser() {
		return $GLOBALS['TSFE']->loginUser;
	}
	
	/**
     * 
     * @return array
     */
    public function getFrontendUserGroups() {
		if($this->hasLoggedInFrontendUser()) {
			return $GLOBALS['TSFE']->fe_user->groupData['uid'];
		}
		return [];
	}

	/**
     * 
     * @return array
     */
    public function getFrontendUserGroupsOrdered() {
		if($this->hasLoggedInFrontendUser()) {
			return explode(',', $GLOBALS['TSFE']->fe_user->user['usergroup']);
		}
		return [];
	}

	/**
     * 
     * @return array
     */
    public function getFrontendUserGroupNames() {
		if($this->hasLoggedInFrontendUser()) {
			return $GLOBALS['TSFE']->fe_user->groupData['title'];
		}
		return [];
	}

	/**
     * 
     * @return array
     */
    public function getFrontendUserGroupData() {
		if($this->hasLoggedInFrontendUser()) {
			return $GLOBALS['TSFE']->fe_user->groupData;
		}
		return [];
	}

	/**
     * 
     * @return int
     */
    public function getFrontendUserUid() {
		if($this->hasLoggedInFrontendUser() && ! empty($GLOBALS['TSFE']->fe_user->user['uid'])) {
			return intval($GLOBALS['TSFE']->fe_user->user['uid']);
		}
		return 0;
	}
		
	/**
     * 
     * @return string
     */
    public function getFrontendUsername() {
		if($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['uid'])) {
			return (string) ($GLOBALS['TSFE']->fe_user->user['username']);
		}
		return '';
	}

	/**
     * 
     * @param int $usergroupUid
     * @return type
     */
    public function hasFrontendUsergroup($usergroupUid = 0) {
		$frontendUsergroups = $this->getFrontendUserGroups();
		return (array_search($usergroupUid, $frontendUsergroups) !== false);
	}
	
    /**
     * 
     * @return bool
     */
    public function isGeneralAdmin() {
        $settings = self::getSettings('accessmanager', 'policy');    
        return \TYPO3\CMS\Core\Utility\GeneralUtility::inList($settings['generalAdminUidList'], $this->getFrontendUserUid());
	}

    /**
     * 
     * @param string $plugin
     * @param string $parameter
     * @return type
     */
    public function getTsSetting($plugin, $parameter) {
        $tsArray = $GLOBALS['TSFE']->fe_user->TSdataArray;
        $value = null;
        foreach($tsArray as $tsSetting) {
            $splittedAssignment = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('=', $tsSetting);
            $splittedPath = explode('.', $splittedAssignment[0]);
            if (($splittedPath[0] == 'plugin') && ($splittedPath[1] == $plugin) && ($splittedPath[2] == $parameter)) {
                $value = $splittedAssignment[1];
            }
        }
        return $value;
    }


    /**
     * 
     * @param string $domainModelObject
     * @param string $accessRequest
     * @param mixed $objectPermissions
     * @param mixed $owner
     * @param mixed $usergroup
     * @return boolean
     */
    public function checkPermission ($domainModelObject, $accessRequest, $objectPermissions = null, $owner = null, $usergroup = null) 
        {
        if (self::isGeneralAdmin()) {
            return true;
        }
        
        if (strpos($owner, '|') !== false) {
            $ownerlist = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode('|', $owner);
            $grouplist = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode('|', $usergroup);
            $permissionlist = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode('|', $objectPermissions);
            $allPermissions = false;
            for($i = 0; $i < count($ownerlist);$i++) {
                $allPermissions |= self::checkPermission($domainModelObject, $accessRequest, $permissionlist[$i], $ownerlist[$i],$grouplist[$i]);
            }
            return $allPermissions;
        }
        
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $policyRepository = $objectManager->get(\CGB\Accessmanager\Domain\Repository\PolicyRepository::class);

        $policies = $policyRepository->findByAlias($domainModelObject);
        if ($policies->count()== 0) {
            $policies = $policyRepository->findByDomainModelObject($domainModelObject);
        }
        $policy = $policies->getFirst();
        if (is_null($policy)) {
            return false;
        }
        
        if (is_object($owner)) {
            $ownerUid = $owner->getUid();
        } elseif (is_int($owner)) {
            $ownerUid = $owner;
        }
        if (is_object($usergroup)) {
            $usergroupUid = $usergroup->getUid();
        } elseif (is_int($usergroup)) {
            $usergroupUid = $usergroup;
        }

		$this->userUid = $this->getFrontendUserUid();
		$this->usergroups = $this->getFrontendUserGroups();

		$allowAccess = false;
        $getUserMethod = 'get' . ucfirst($accessRequest) . 'user';
        $getGroupMethod = 'get' . ucfirst($accessRequest) . 'group';

        if ($policyRepository) {
            // user is in list of alowed users
            $allowAccess = \TYPO3\CMS\Core\Utility\GeneralUtility::inList($policy->{$getUserMethod}(), $this->userUid);

            // usergroup is in list og alowed users
            $allowedObjectGroupsArray = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $policy->{$getGroupMethod}()); 
            $allowAccess = $allowAccess || count(array_intersect($allowedObjectGroupsArray, $this->usergroups)) > 0;
        }
        
        if ($allowAccess) {
            return true;
        }
        
		$permissionMask = ($ownerUid == $this->userUid) ? 0700 : 0;
        
        if (array_search($usergroupUid, $this->usergroups) !== false) {
            $permissionMask = $permissionMask | 0070;
        }

        $permissionMask = $permissionMask | 0007;

        if (! $objectPermissions) {
            $objectPermissions = $policy->getPermissions();
        }
        $objectPermissions = octdec((string) $objectPermissions);
        
        switch ($accessRequest) {
            case 'read':
                $rights = $permissionMask & $objectPermissions & 0444;
                break;

            case 'write':
                $rights = $permissionMask & $objectPermissions & 0222;
                break;

            case 'delete':
                $rights = $permissionMask & $objectPermissions & 0111;
                break;
            
            default: $rights = 0;
        }
		return ($rights > 0);
	}
    
}
