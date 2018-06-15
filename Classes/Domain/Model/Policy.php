<?php
namespace CGB\Accessmanager\Domain\Model;

/***
 *
 * This file is part of the "accessManager" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Christoph Balogh <cb@lustige-informatik.at>
 *
 ***/

/**
 * Polica
 */
class Policy extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Domain Model Object
     *
     * @var string
     * @validate NotEmpty
     */
    protected $domainModelObject = '';

    /**
     * Default Permissions
     *
     * @var int
     */
    protected $permissions = 0;

    /**
     * Read Access User
     *
     * @var string
     */
    protected $readuser = '';

    /**
     * Read Access Group
     *
     * @var string
     */
    protected $readgroup = '';

    /**
     * Write Access User
     *
     * @var string
     */
    protected $writeuser = '';

    /**
     * Write Access Group
     *
     * @var string
     */
    protected $writegroup = '';

    /**
     * Delete Access User
     *
     * @var string
     */
    protected $deleteuser = '';

    /**
     * Delete Access Group
     *
     * @var string
     */
    protected $deletegroup = '';

    /**
     * Create Access User
     *
     * @var string
     */
    protected $createuser = '';

    /**
     * Create Access Group
     *
     * @var string
     */
    protected $creategroup = '';

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {

    }

    /**
     * Returns the domainModelObject
     *
     * @return string $domainModelObject
     */
    public function getDomainModelObject()
    {
        return $this->domainModelObject;
    }

    /**
     * Sets the domainModelObject
     *
     * @param string $domainModelObject
     * @return void
     */
    public function setDomainModelObject($domainModelObject)
    {
        $this->domainModelObject = $domainModelObject;
    }

    /**
     * Returns the permissions
     *
     * @return int $permissions
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Sets the permissions
     *
     * @param int $permissions
     * @return void
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * Returns the readuser
     *
     * @return string $readuser
     */
    public function getReaduser()
    {
        return $this->readuser;
    }

    /**
     * Sets the readuser
     *
     * @param string $readuser
     * @return void
     */
    public function setReaduser($readuser)
    {
        $this->readuser = $readuser;
    }

    /**
     * Returns the readgroup
     *
     * @return string $readgroup
     */
    public function getReadgroup()
    {
        return $this->readgroup;
    }

    /**
     * Sets the readgroup
     *
     * @param string $readgroup
     * @return void
     */
    public function setReadgroup($readgroup)
    {
        $this->readgroup = $readgroup;
    }

    /**
     * Returns the writeuser
     *
     * @return string $writeuser
     */
    public function getWriteuser()
    {
        return $this->writeuser;
    }

    /**
     * Sets the writeuser
     *
     * @param string $writeuser
     * @return void
     */
    public function setWriteuser($writeuser)
    {
        $this->writeuser = $writeuser;
    }

    /**
     * Returns the writegroup
     *
     * @return string $writegroup
     */
    public function getWritegroup()
    {
        return $this->writegroup;
    }

    /**
     * Sets the writegroup
     *
     * @param string $writegroup
     * @return void
     */
    public function setWritegroup($writegroup)
    {
        $this->writegroup = $writegroup;
    }

    /**
     * Returns the deleteuser
     *
     * @return string $deleteuser
     */
    public function getDeleteuser()
    {
        return $this->deleteuser;
    }

    /**
     * Sets the deleteuser
     *
     * @param string $deleteuser
     * @return void
     */
    public function setDeleteuser($deleteuser)
    {
        $this->deleteuser = $deleteuser;
    }

    /**
     * Returns the deletegroup
     *
     * @return string $deletegroup
     */
    public function getDeletegroup()
    {
        return $this->deletegroup;
    }

    /**
     * Sets the deletegroup
     *
     * @param string $deletegroup
     * @return void
     */
    public function setDeletegroup($deletegroup)
    {
        $this->deletegroup = $deletegroup;
    }

    /**
     * Returns the createuser
     *
     * @return string $createuser
     */
    public function getCreateuser()
    {
        return $this->createuser;
    }

    /**
     * Sets the createuser
     *
     * @param string $createuser
     * @return void
     */
    public function setCreateuser($createuser)
    {
        $this->createuser = $createuser;
    }

    /**
     * Returns the creategroup
     *
     * @return string $creategroup
     */
    public function getCreategroup()
    {
        return $this->creategroup;
    }

    /**
     * Sets the creategroup
     *
     * @param string $creategroup
     * @return void
     */
    public function setCreategroup($creategroup)
    {
        $this->creategroup = $creategroup;
    }
}
