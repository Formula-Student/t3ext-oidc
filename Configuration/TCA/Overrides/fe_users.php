<?php
defined('TYPO3_MODE') || die();

if (version_compare(TYPO3_version, '9.0', '<')) {
    $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['oidc']);
} else {
    $settings = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['oidc'] ?? [];
}

$tempColumns = [
    'tx_oidc' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:oidc/Resources/Private/Language/locallang_db.xlf:fe_users.tx_oidc',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'readOnly' => (bool)$settings['frontendUserMustExistLocally'] ? 0 : 1,
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'tx_oidc');
