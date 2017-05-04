<?php

namespace EdmondsCommerce\MagentoModuleVersions;

abstract class AbstractModule
{
    protected $dom;

    protected $page;

    abstract public function getSelector();

    abstract public function cleanVersionNumber($versionNumber);

    public function __construct($dom, $page)
    {
        $this->dom = $dom;
        $this->page = $page;
    }

    public function getLatestVersion()
    {
        $this->dom->loadFromUrl($this->page);
        $versionInnerHtml = $this->dom->find($this->getSelector(), 0)->innerHtml;
        $versionNumber = $this->cleanVersionNumber($versionInnerHtml);
        return $versionNumber;
    }
}