<?php

/**
 * Offline Access
 *
 * Allow specific users to bypass the shop-offline screen.
 *
 * @author  Jay Trees <offline-access@grandels.email>
 * @package GrandelJayOfflineAccess
 */

use RobinTheHood\ModifiedStdModule\Classes\StdModule;

require_once DIR_FS_DOCUMENT_ROOT . '/vendor-no-composer/autoload.php';

class grandeljay_offline_access extends StdModule
{
    public const VERSION = '0.1.0';

    public static function getModuleMeta(): array
    {
        $first_underscore_pos = strpos(self::class, '_');

        $module_meta = array(
            'namespace' => substr(self::class, 0, $first_underscore_pos),
            'name'      => substr(self::class, $first_underscore_pos + 1),
        );

        return $module_meta;
    }

    public static function setCookieOfflineAccess()
    {
        $module_meta      = self::getModuleMeta();
        $module_name      = $module_meta['name'];
        $module_namespace = $module_meta['namespace'];
        $cookie_name      = $module_namespace . '_' . $module_name;

        if (isset($_SESSION[$module_namespace][$module_name][$cookie_name])) {
            $cookie_value   = true;
            $cookie_expires = time() + 3600 * 24 * 30;
            $cookie_path    = '/';

            $set_cookie = setcookie(
                $cookie_name,
                $cookie_value,
                $cookie_expires,
                $cookie_path,
            );

            if ($set_cookie) {
                unset($_SESSION[$module_namespace][$module_name][$cookie_name]);
            } else {
                throw new Exception('Failed to set cookie');
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
        $this->init('MODULE_GRANDELJAY_OFFLINE_ACCESS');

        $this->addAction('SetCookieOfflineAccess', MODULE_GRANDELJAY_OFFLINE_ACCESS_ALLOW_DEVICE_OFFLINE_ACCESS);
    }

    public function display()
    {
        return $this->displaySaveButton();
    }

    public function install()
    {
        parent::install();
    }

    public function remove()
    {
        parent::remove();
    }

    protected function invokeSetCookieOfflineAccess()
    {
        $module_meta      = self::getModuleMeta();
        $module_name      = $module_meta['name'];
        $module_namespace = $module_meta['namespace'];
        $cookie_name      = $module_namespace . '_' . $module_name;

        /**
         * Set a marker, so the cookie can be set earlier on the next page load.
         *
         * If output exists prior to calling this function, setcookie() will
         * fail and return false.
         *
         * @see https://www.php.net/manual/en/function.setcookie.php
         */
        if (!isset($_COOKIE[$cookie_name])) {
            $_SESSION[$module_namespace][$module_name][$cookie_name] = true;
        }
    }
}
