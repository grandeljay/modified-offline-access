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
    'TITLE'                           => 'grandeljay - Offline-Zugriff',
    'LONG_DESCRIPTION'                => 'Ermöglicht es bestimmten Benutzern, den Shop-Offline-Bildschirm zu umgehen.',
    'STATUS_TITLE'                    => 'Modul aktivieren?',
    'STATUS_DESC'                     => '',

    /** Settings */
    'ALLOW_DEVICE_OFFLINE_ACCESS'     => 'Offline-Zugriff aktivieren',
    'DISALLOW_DEVICE_OFFLINE_ACCESS'  => 'Offline-Zugriff deaktivieren',

    /** Messages */
    'OFFLINE_ACCESS_ENABLED_SUCCESS'  => 'Der Offline-Zugriff wurde erfolgreich aktiviert.',
    'OFFLINE_ACCESS_ENABLED_FAILURE'  => 'Der Offline-Zugriff konnte nicht aktiviert werden.',
    'OFFLINE_ACCESS_DISABLED_SUCCESS' => 'Der Offline-Zugriff wurde erfolgreich deaktiviert.',
    'OFFLINE_ACCESS_DISABLED_FAILURE' => 'Der Offline-Zugriff konnte nicht deaktiviert werden.',
);

foreach ($translations as $key => $value) {
    $constant = 'MODULE_' . strtoupper(pathinfo(__FILE__, PATHINFO_FILENAME)) . '_' . $key;

    define($constant, $value);
}
