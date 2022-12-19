<?php

/**
 * Offline Access
 *
 * Allow specific users to bypass the shop-offline screen.
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @package GrandelJayOfflineAccess
 */

require DIR_ADMIN . '/includes/modules/system/grandeljay_offline_access.php';

grandeljay_offline_access::setCookieOfflineAccess();
