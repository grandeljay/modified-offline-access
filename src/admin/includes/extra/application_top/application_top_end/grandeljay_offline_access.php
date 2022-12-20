<?php

/**
 * Offline Access
 *
 * Allow specific users to bypass the shop-offline screen.
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @package GrandelJayOfflineAccess
 */

if (!defined('MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS') || 'true' !== MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS) {
    return;
}

if (FILENAME_MODULE_EXPORT === basename($_SERVER['PHP_SELF'])) {
    return;
}

include_once DIR_FS_ADMIN . '/includes/modules/system/grandeljay_offline_access.php';

grandeljay_offline_access::setCookieOfflineAccess();
