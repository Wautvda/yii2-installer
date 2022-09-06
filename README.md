Yii2-Installer
==============

Yii2-Installer provides a web interface for installation of a yii2 project. It includes following features:

## Features

- Setup database connection
- Execute all migrations if migrations are setup correctly (more in [migrations](docs/installation/migrations.md)) and migrationoption is turned on (see [configuration](docs/configuration/settings.md)
- Setup mailer configuration
- Setup other configurations like:
    - Application Name
    - Admin Email
- Stores all the configurations on file
- Creates admin user (see [user requirements](docs/installation/user.md))

## Installation

You can download it and place it on your third party libraries folder but we highly recommend that you install it through [composer](http://getcomposer.org/download/).
 
 Either run
```bash
$ composer require weblogic/yii2-installer:*
``` 
or add
```
"weblogic/yii2-installer": "*"
```
 to the `require` section of your `composer.json` file.

## Documentation

Refer to [Documentation](docs/index.md)

## Roadmap

- [x] Add translations
- [x] Installation wizard
- [x] Add user

## Changelog

Refer to [Changelog](CHANGELOG.md)

## License

Yii2-installer is released under the BSD License. See the bundled [LICENSE](LICENSE.md) for details.