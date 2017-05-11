# Magento Module Version Checker

## By [Edmonds Commerce](https://www.edmondscommerce.co.uk)

A simple script to check
[Magento Connect](https://www.magentocommerce.com/magento-connect/)
(or other custom sources) for the latest version of a module.

### Installation

Install via composer

```bash
git clone git@github.com:edmondscommerce/magento-module-version-checker.git
cd magento-module-version-checker
composer install
```

### Configuration

You need to configure the modules you wish to check and the page from which
to get the modules version. You do this in a `json` file with the following
format:

```json
{
    "https://www.magentocommerce.com/magento-connect/<module>": "<Module_Name>",
    "https://www.magentocommerce.com/magento-connect/aoe-scheduler.html": "Aoe_Scheduler",

    ...
}
```

### Running

```
./mmv <path/to/config.json>
```

### Custom Sources

In order to add a custom source you need implement a `Module` class and add the class to the `ModuleFactory`.

#### Implementing Module

I've created a template `Module` class for you to base yours on [here](https://github.com/edmondscommerce/magento-module-version-checker/blob/master/src/Module.php.template).

You simply need to make the following changes:

```php
<?php

namespace EdmondsCommerce\MagentoModuleVersions;

class <YourSource>Module extends AbstractModule
{
    public function getSelector()
    {
        // Here you need to add a css selector to grab the
        // version data from the page.
        return '';
    }

    public function cleanVersionNumber($versionNumber)
    {
        // Here you need to add some clean up code that takes the
        // selected version and strips out only the version number.
        return $versionNumber;
    }
}
```

You can see an example of this
[here](https://github.com/edmondscommerce/magento-module-version-checker/blob/master/src/MagentoConnectModule.php).

#### Adding Module to Module Factory

Once you've implemented a `Module` class you need to add it to the
[`ModuleFactory`](https://github.com/edmondscommerce/magento-module-version-checker/blob/master/src/ModuleFactory.php).

```php
<?php
...
class ModuleFactory
{
    ...
    public static function create($dom, $page)
    {
        ...
        switch ($host) {
            case 'www.magentocommerce.com':
                return new MagentoConnectModule($dom, $page);
                break;
            case 'www.your-modules-domain.com':
                return new <YourSource>Module($dom, $page);
                break;
            default:
                throw new Exception("Invalid host '$host'");
        }
    }
}
```

Once that's done you should be able to add your new modules to the config `json` and run the script.
