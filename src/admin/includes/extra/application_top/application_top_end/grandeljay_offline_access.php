<?php

/**
 * Offline Access
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @link    https://github.com/grandeljay/modified-offline-access
 * @package GrandelJayOfflineAccess
 */

if (!defined('MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS') || 'true' !== MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS) {
    return;
}

include_once DIR_FS_ADMIN . '/includes/modules/system/grandeljay_offline_access.php';

grandeljay_offline_access::setCookieOfflineAccess();
