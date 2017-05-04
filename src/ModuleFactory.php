<?php

namespace EdmondsCommerce\MagentoModuleVersions;

use stringEncode\Exception;

class ModuleFactory
{
    // NOTES
    //
    // - can't do Fishpig as they load version data using JS
    // - can't do Ebizmarts as they don't display version numbers

    /**
     * @param $dom
     * @param $page
     * @return FishpigModule|MagentoConnectModule
     * @throws Exception
     */
    public static function create($dom, $page)
    {
        $url = parse_url($page);
        $host = $url['host'];

        switch ($host) {
            case 'www.magentocommerce.com':
                return new MagentoConnectModule($dom, $page);
                break;
            default:
                throw new Exception("Invalid host '$host'");
        }
    }
}