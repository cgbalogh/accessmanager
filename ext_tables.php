<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'CGB.Accessmanager',
            'Policy',
            'Policy'
        );

        $pluginSignature = str_replace('_', '', 'accessmanager') . '_policy';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:accessmanager/Configuration/FlexForms/flexform_policy.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('accessmanager', 'Configuration/TypoScript', 'accessManager');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_accessmanager_domain_model_policy', 'EXT:accessmanager/Resources/Private/Language/locallang_csh_tx_accessmanager_domain_model_policy.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_accessmanager_domain_model_policy');

    }
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder