<?php

/**
 * Offline Access
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @link    https://github.com/grandeljay/modified-offline-access
 * @package GrandelJayOfflineAccess
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 */

use RobinTheHood\ModifiedStdModule\Classes\StdModule;

class grandeljay_offline_access extends StdModule
{
    public const VERSION                     = '0.2.4';
    private const INVOKE_ACTION_SET_COOKIE   = 'SetCookieOfflineAccess';
    private const INVOKE_ACTION_UNSET_COOKIE = 'UnsetCookieOfflineAccess';

    public static function getModuleMeta(): array
    {
        $first_underscore_pos = strpos(self::class, '_');

        $module_meta = array(
            'namespace' => substr(self::class, 0, $first_underscore_pos),
            'name'      => substr(self::class, $first_underscore_pos + 1),
        );

        return $module_meta;
    }

    /**
     * Set the actual cookie
     */
    public static function setCookieOfflineAccess()
    {
        $module_meta      = self::getModuleMeta();
        $module_name      = $module_meta['name'];
        $module_namespace = $module_meta['namespace'];

        $cookie_name = $module_namespace . '_' . $module_name;

        if (!(isset($_GET['module']) && self::class === $_GET['module'])) {
            return;
        }

        $cookie_path = '/';

        if (isset($_GET['moduleaction']) && in_array($_GET['moduleaction'], array(self::INVOKE_ACTION_SET_COOKIE, self::INVOKE_ACTION_UNSET_COOKIE), true)) {
            switch ($_GET['moduleaction']) {
                case self::INVOKE_ACTION_SET_COOKIE:
                    $cookie_value   = true;
                    $cookie_expires = time() + 3600 * 24 * 30;
                    break;

                case self::INVOKE_ACTION_UNSET_COOKIE:
                    $cookie_value   = false;
                    $cookie_expires = -1;
                    break;
            }

            $set_cookie = setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

            $_GET[$_GET['moduleaction']] = $set_cookie;
            unset($_GET['moduleaction']);
            xtc_redirect(xtc_href_link('module_export.php', http_build_query($_GET), 'SSL'));
        }

        /**
         * Message
         */
        global $messageStack;

        require_once DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/system/grandeljay_offline_access.php';

        if (isset($_GET[self::INVOKE_ACTION_SET_COOKIE])) {
            if (boolval($_GET[self::INVOKE_ACTION_SET_COOKIE])) {
                $messageStack->add(MODULE_GRANDELJAY_OFFLINE_ACCESS_OFFLINE_ACCESS_ENABLED_SUCCESS, 'success');
            } else {
                $messageStack->add(MODULE_GRANDELJAY_OFFLINE_ACCESS_OFFLINE_ACCESS_ENABLED_FAILURE, 'warning');
            }
        }

        if (isset($_GET[self::INVOKE_ACTION_UNSET_COOKIE])) {
            if (boolval($_GET[self::INVOKE_ACTION_UNSET_COOKIE])) {
                $messageStack->add(MODULE_GRANDELJAY_OFFLINE_ACCESS_OFFLINE_ACCESS_DISABLED_SUCCESS, 'success');
            } else {
                $messageStack->add(MODULE_GRANDELJAY_OFFLINE_ACCESS_OFFLINE_ACCESS_DISABLED_FAILURE, 'warning');
            }
        }
    }

    public static function isOfflineAccessAllowed(): bool
    {
        $module_meta      = self::getModuleMeta();
        $module_name      = $module_meta['name'];
        $module_namespace = $module_meta['namespace'];
        $cookie_name      = $module_namespace . '_' . $module_name;

        $isOfflineAccessAllowed = !isset($_COOKIE[$cookie_name]);

        return $isOfflineAccessAllowed;
    }

    public function __construct()
    {
        parent::__construct();

        $this->checkForUpdate(true);

        if (self::isOfflineAccessAllowed()) {
            if (defined('MODULE_GRANDELJAY_OFFLINE_ACCESS_ALLOW_DEVICE_OFFLINE_ACCESS')) {
                $this->addAction(
                    self::INVOKE_ACTION_SET_COOKIE,
                    MODULE_GRANDELJAY_OFFLINE_ACCESS_ALLOW_DEVICE_OFFLINE_ACCESS
                );
            }
        } else {
            if (defined('MODULE_GRANDELJAY_OFFLINE_ACCESS_DISALLOW_DEVICE_OFFLINE_ACCESS')) {
                $this->addAction(
                    self::INVOKE_ACTION_UNSET_COOKIE,
                    MODULE_GRANDELJAY_OFFLINE_ACCESS_DISALLOW_DEVICE_OFFLINE_ACCESS
                );
            }
        }
    }

    public function display()
    {
        return $this->displaySaveButton();
    }

    public function install()
    {
        parent::install();
    }

    protected function updateSteps()
    {
        if (version_compare($this->getVersion(), self::VERSION, '<')) {
            $this->setVersion(self::VERSION);

            return self::UPDATE_SUCCESS;
        }

        return self::UPDATE_NOTHING;
    }

    public function remove()
    {
        parent::remove();
    }
}
