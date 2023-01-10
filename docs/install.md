## Installation

In order for this module to work, place the following code into `/inc/xtc_get_shop_conf.inc.php`. The code needs to be at the end of the function `get_shop_offline_status`, right **before** `return true;` which is around line `71`.

```php
/**
 * Offline Access
 *
 * Allow specific users to bypass the shop-offline screen.
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @package GrandelJayOfflineAccess
 */
if (defined('MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS') && 'true' === MODULE_GRANDELJAY_OFFLINE_ACCESS_STATUS) {
    return grandeljay_offline_access::isOfflineAccessAllowed();
}
/** */
```

**Warning**: this is a core file of modified. It will likely be overwritten when you update. Please make sure to add it again after a modified core update.
