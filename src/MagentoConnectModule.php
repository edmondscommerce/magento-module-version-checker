<?php

namespace EdmondsCommerce\MagentoModuleVersions;

class MagentoConnectModule extends AbstractModule
{
    public function getSelector()
    {
        return '#extension-version-list-container .extension-version .extension-version-meta li';
    }

    public function cleanVersionNumber($versionNumber)
    {
        return trim(substr($versionNumber, 33));
    }
}