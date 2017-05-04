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

tbc