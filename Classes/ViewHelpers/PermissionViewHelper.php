<?php
namespace CGB\Accessmanager\ViewHelpers;
// use TYPO3Fluid\Fluid\ViewHelpers\Form;

class PermissionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    
    /**
     * accessControlService
     *
     * @var \CGB\Accessmanager\Service\AccessControlService
     * @inject
     */
    protected $accessControlService = null;

    /**
     * 
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('domainModelObject', 'string', 'Name of the domain model object', false, false);
        $this->registerArgument('intendedAction', 'string', 'Intended action to execute', false, false);
        $this->registerArgument('permissions', 'string', 'Permissions', false, false);
        $this->registerArgument('user', 'mixed', 'User', false, false);
        $this->registerArgument('group', 'mixed', 'Group', false, false);
    }

    /**
     * Render the tag.
     *
     * @return string rendered tag.
     */
    public function render()
    {
        return $this->accessControlService->checkPermission ( 
            $this->arguments['domainModelObject'], 
            $this->arguments['intendedAction'], 
            $this->arguments['permissions'], 
            $this->arguments['user'], 
            $this->arguments['group']);
    }
}
