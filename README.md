Yii2-Installer
==============

Yii2-Installer provides a web interface for installation of a yii2 project. It includes following features:

## Features

- Setup database correctly
- Execute all migrations if migrations are setup correctly (more in [migrations](docs/migrations.md))
- Setup other configurations like:
    - Application Name
    - Admin Email
- Stores all the configurations on file

## Installation

This document will guide you through the process of installing Yii2-Installer using **composer**.

Add Yii2-installer to the require section of your **composer.json** file:

```php
{
    "require": {
        "weblogic/yii2-installer": "*"
    }
}
```

And run following command to download extension using **composer**:

```bash
$ composer install
```

## Roadmap

- [ ] Installation wizard
- [ ] Add admin user

## Change Log

Refer to [Change Logs](CHANGE.md)

## License

Yii2-installer is released under the MIT License. See the bundled [LICENSE](LICENSE.md) for details.