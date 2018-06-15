<?php

$itemsUsers = [
    ['Allow to any user', -1],
    [' Users:', '--div--'],
];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config'] = $GLOBALS['TCA']['tt_content']['columns']['fe_group']['config'];
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config']['items'] = $itemsUsers;
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config']['exclusiveKeys'] = -1;
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config']['foreign_table'] = 'fe_users';
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config']['foreign_table_where'] = 'ORDER BY fe_users.username';


$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config'] = $GLOBALS['TCA']['tt_content']['columns']['fe_group']['config'];
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config']['items'] = [];
$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config']['exclusiveKeys'] = '';

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['writeuser']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config'];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['writegroup']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config'];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['deleteuser']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config'];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['deletegroup']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config'];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['createuser']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readuser']['config'];

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['creategroup']['config'] =
    $GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['readgroup']['config'];


$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['types']['1']['showitem'] = 
    'sys_language_uid, l10n_parent, l10n_diffsource, hidden, domain_model_object, alias, permissions, --div--;Read, readuser, readgroup, --div--;Write, writeuser, writegroup, --div--;Delete, deleteuser, deletegroup, --div--;Create, createuser, creategroup';

$GLOBALS['TCA']['tx_accessmanager_domain_model_policy']['columns']['domain_model_object'] = array(
    'exclude' => 1,
    'label' => 'LLL:EXT:accessmanager/Resources/Private/Language/locallang_db.xlf:tx_accessmanager_domain_model_policy.domain_model_object',
    'config' => array(
        'type' => 'select',
        'itemsProcFunc' => 'CGB\Accessmanager\UserFunc\TcaUserFunc->getDomainModelObjects',
        'renderType' => 'selectSingle',
        'size' => 1,
        'maxitems' => 1,
    ),
);