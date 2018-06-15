<?php
namespace CGB\Accessmanager\ViewHelpers;
// use TYPO3Fluid\Fluid\ViewHelpers\Form;

class ActioniconViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
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
        $this->registerArgument('accessRequest', 'string', 'Requiest access to action type', false, false);
        $this->registerArgument('intendedAction', 'string', 'Intended action to execute', false, false);
        $this->registerArgument('action', 'string', 'Action if different from intendedaction to execute', false, false);
        $this->registerArgument('forceIcon', 'string', 'Take different icon', false, false);
        $this->registerArgument('child', 'string', 'Add/Remove child of type', false, false);
        $this->registerArgument('permissions', 'string', 'Permissions', false, false);
        $this->registerArgument('user', 'mixed', 'User', false, false);
        $this->registerArgument('group', 'mixed', 'Group', false, false);
        $this->registerArgument('pageType', 'int', 'URI pageType', false, false);
        $this->registerArgument('pageUid', 'int', 'URI pageUid', false, false);
        $this->registerArgument('extensionName', 'string', 'URI extensionName', false, false);
        $this->registerArgument('pluginName', 'string', 'URI pluginName', false, false);
        $this->registerArgument('controller', 'string', 'URI controller', false, false);
        $this->registerArgument('uri', 'string', 'URI', false, false);
        $this->registerArgument('alturi', 'string', 'alt URI for editorshow', false, false);
        $this->registerArgument('mapArgumentName', 'string', 'URI controller', false, false);
        $this->registerArgument('arguments', 'array', 'URI arguments', false, false);
    }

    /**
     * Render the tag.
     *
     * @return string rendered tag.
     */
    public function render()
    {
        if ($this->arguments['mapArgumentName']) {
            $mappingList = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->arguments['mapArgumentName']);
            foreach ($mappingList as $singleMapping) {
                $subMappingList = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('->', $singleMapping);
                $oldKey = $subMappingList[0];
                $newKey = $subMappingList[1];
                $this->arguments['arguments'][$newKey] = $this->arguments['arguments'][$oldKey];
                unset($this->arguments['arguments'][$oldKey]);
            }
        }
        
        if ($this->arguments['action'] == 'removeRelation') $debug = 0;
        
        $settings = \CGB\Accessmanager\Service\AccessControlService::getSettings('accessmanager', 'policy');
        
        $allowRead = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'read', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);

        $allowWrite = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'write', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);

        $allowDelete = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'delete', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);

        $allowNew = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'create', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);

        $allowAdd = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'write', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);

        $allowRemove = $this->accessControlService->checkPermission ( $this->arguments['domainModelObject'], 
            'write', $this->arguments['permissions'], $this->arguments['user'], $this->arguments['group']);
        
        if ($this->arguments['action']) {
            $prependTitle = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_accessmanager_domain_model_policy.' . $this->arguments['action'], 'accessmanager');
        } else {
            $prependTitle = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_accessmanager_domain_model_policy.' . $this->arguments['intendedAction'], 'accessmanager');
        }

        $uri = $this->arguments['uri'];
        
        switch($this->arguments['intendedAction']) {
            case 'add':
                if ($allowAdd) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['addAction'].$this->arguments['child'] ;
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['addIcon'];
                }
                break;

            case 'remove':
                if ($allowAdd) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['removeAction'].$this->arguments['child'] ;
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['removeIcon'];
                }
                break;
                
            case 'show':
                if ($allowRead) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['showAction'];
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['showIcon'];
                    $this->tag->addAttribute('readonly', 1);
                }
                break;

            case 'edit':
                if ($debug) {
                    echo $this->arguments['domainModelObject'];
                    echo ' write ';
                    echo $this->arguments['permissions'];
                    echo $this->arguments['user'];
                    echo $this->arguments['group'];
                    echo $allowWrite;
                }
                if ($allowWrite) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['editAction'];
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['editIcon'];
                }
                if ($debug) {
                    echo "~~ $action ..";
                    echo "<br />";
                }
                break;
            
            case 'editorshow':
                if ($allowWrite) {
                    $action = $settings['editAction'];
                    $prependTitle = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_accessmanager_domain_model_policy.edit', 'accessmanager');
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['editIcon'];;
                } elseif ($allowRead) {
                    $action = $settings['showAction'];
                    $prependTitle = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_accessmanager_domain_model_policy.show', 'accessmanager');
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['showIcon'];
                    $this->tag->addAttribute('readonly', 1);
                    $uri = $this->arguments['alturi'];
                }
                break;

            case 'delete':
                if ($allowDelete) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['deleteAction'];
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['deleteIcon'];
                }
                break;

            case 'new':
                if ($allowNew) {
                    $action = $this->arguments['action'] ? $this->arguments['action'] : $settings['newAction'];
                    $this->arguments['src'] = $this->arguments['forceIcon'] ? $settings[$this->arguments['forceIcon']] : $settings['newIcon'];
                }
                break;
        }

        if ($action) {
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $iconImageViewHelper = $objectManager->get(\TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::class);
            $iconImageViewHelper->initialize();
            
            $iconImageViewHelper->setArguments(['src' => $this->arguments['src']]);
            $iconImageViewHelper->tag->addAttribute('class', 'accessmanager-titleicon');
            $iconImageViewHelper->tag->addAttribute('style', 'display: inline-block;float:left;margin-right:4px;margin-top:1px;');
            $iconImage = $iconImageViewHelper->render();

            $this->arguments['additionalParams'] = [];
            $this->arguments['argumentsToBeExcludedFromQueryString'] = [];
            $this->arguments['format'] = '';
            
            // prepend title with tag text
            $title = $this->tag->getAttribute('title');
            $this->tag->addAttribute('title', $prependTitle . ($title ? ': ' : '') . $title);

            if (! $this->arguments['uri']) {
                $uriBuilder = $this->renderingContext->getControllerContext()->getUriBuilder();
                $uri = $uriBuilder
                    ->reset()
                    ->setTargetPageUid($this->arguments['pageUid'])
                    ->setTargetPageType($this->arguments['pageType'])
                    ->setNoCache($this->arguments['noCache'])
                    ->setUseCacheHash(!$this->arguments['noCacheHash'])
                    ->setSection($this->arguments['section'])
                    ->setFormat($this->arguments['format'])
                    ->setLinkAccessRestrictedPages($this->arguments['linkAccessRestrictedPages'])
                    ->setArguments($this->arguments['additionalParams'])
                    ->setCreateAbsoluteUri($this->arguments['absolute'])
                    ->setAddQueryString($this->arguments['addQueryString'])
                    ->setArgumentsToBeExcludedFromQueryString($this->arguments['argumentsToBeExcludedFromQueryString'])
                    ->setAddQueryStringMethod($this->arguments['addQueryStringMethod'])
                    ->uriFor($action, $this->arguments['arguments'], $this->arguments['controller'], $this->arguments['extensionName'], $this->arguments['pluginName']);
            }
            
            $this->tag->forceClosingTag(true);
            $this->tag->addAttribute('uri', $uri);
            $this->tag->addAttribute('icon', $iconImage);
            // $this->tag->addAttribute('additionalAttributes', $this->arguments['additionalAttributes']);
            $imageTag = parent::render();
            return $imageTag;
        }
    }
}
