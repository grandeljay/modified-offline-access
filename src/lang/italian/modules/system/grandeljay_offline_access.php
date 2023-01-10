<?php

/**
 * Offline Access
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @link    https://github.com/grandeljay/modified-offline-access
 * @package GrandelJayOfflineAccess
 */

$translations = array(
    /** Module */
    'TITLE'                           => 'grandeljay - Offline Access',
    'LONG_DESCRIPTION'                => 'Allow specific users to bypass the shop-offline screen.',
    'STATUS_TITLE'                    => 'Activate module?',
    'STATUS_DESC'                     => '',

    /** Settings */
    'ALLOW_DEVICE_OFFLINE_ACCESS'     => 'Activate offline access',
    'DISALLOW_DEVICE_OFFLINE_ACCESS'  => 'Deactivate offline access',

    /** Messages */
    'OFFLINE_ACCESS_ENABLED_SUCCESS'  => 'Offline access was successfully enabled.',
    'OFFLINE_ACCESS_ENABLED_FAILURE'  => 'Offline access could not be enabled.',
    'OFFLINE_ACCESS_DISABLED_SUCCESS' => 'Offline access was successfully disabled.',
    'OFFLINE_ACCESS_DISABLED_FAILURE' => 'Offline access could not be disabled.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
