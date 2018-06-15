<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy',
        'label' => 'domain_model_object',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'domain_model_object,alias,permissions,readuser,readgroup,writeuser,writegroup,deleteuser,deletegroup,createuser,creategroup',
        'iconfile' => 'EXT:accessmanager/Resources/Public/Icons/tx_accessmanager_domain_model_policy.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, domain_model_object, alias, permissions, readuser, readgroup, writeuser, writegroup, deleteuser, deletegroup, createuser, creategroup',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, domain_model_object, alias, permissions, readuser, readgroup, writeuser, writegroup, deleteuser, deletegroup, createuser, creategroup'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_accessmanager_domain_model_policy',
                'foreign_table_where' => 'AND tx_accessmanager_domain_model_policy.pid=###CURRENT_PID### AND tx_accessmanager_domain_model_policy.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],

        'domain_model_object' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.domain_model_object',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'alias' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.alias',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'permissions' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.permissions',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'readuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.readuser',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'readgroup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.readgroup',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'writeuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.writeuser',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'writegroup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.writegroup',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'deleteuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.deleteuser',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'deletegroup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.deletegroup',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'createuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.createuser',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'creategroup' => [
            'exclude' => true,
            'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.creategroup',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    
    ],
];
