<?php

namespace Savvii;

/**
 * Class Options
 * @package Savvii
 */
class Options {

    /**************************************************
     * Names consts
     **************************************************/

    const CACHING_STYLE             = 'warpdrive.caching_style';
    const CDN_ENABLE                = 'warpdrive.cdn_enabled';
    const CDN_DOMAIN_FORMAT         = 'cdn.%s.savviihq.com';
    const REPO_LOCATION             = 'https://github.com/Savvii/warpdrive';
    const REPO_RELEASES_LOCATION    = 'https://api.github.com/repos/Savvii/warpdrive/releases/latest';

    /**************************************************
     * Groups consts
     **************************************************/

    /**************************************************
     * Static access to options
     **************************************************/

    public static function api_location() {
        return getenv( 'WARPDRIVE_API' );
    }

    public static function access_token() {
        return getenv( 'WARPDRIVE_ACCESS_TOKEN' );
    }

    public static function system_name() {
        return getenv( 'WARPDRIVE_SYSTEM_NAME' );
    }

    public static function cdn_domain() {
        return sprintf( self::CDN_DOMAIN_FORMAT, self::system_name() );
    }
}
