<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'CGB.Accessmanager',
            'Policy',
            [
                'Policy' => 'list, edit, update, new, create, show, delete'
            ],
            // non-cacheable actions
            [
                'Policy' => 'list, edit, update, new, create, show, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    policy {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('accessmanager') . 'Resources/Public/Icons/user_plugin_policy.svg
                        title = LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy
                        description = LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.description
                        tt_content_defValues {
                            CType = list
                            list_type = accessmanager_policy
                        }
                    }
                }
                show = *
            }
       }'
    );
    }
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
        wizards.newContentElement.wizardItems.plugins {
            elements {
                policy >
            }
        }
   }'
);