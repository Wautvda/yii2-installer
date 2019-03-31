Yii 2 Installer
===============

Yii2-Installer provides a web interface for installation of a yii2 project. It includes following features:

## Features

- Setup database connection
- Execute all migrations if migrations are setup correctly (more in [migrations](installation/migrations.md))
- Setup mailer configuration
- Setup other configurations like:
    - Application Name
    - Admin Email
- Stores all the configurations on file

## Getting Started

This extension has been built to be working `out of the box`, that is, after you install its migrations and configure 
the module on your application structure, you should be set to go. 

#### Step 1 - Download

You can download it and place it on your third party libraries folder but we highly recommend that you install it 
through [composer](http://getcomposer.org/download/).

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

#### Step 2 - Configure migrations

See [migrations](installation/migrations.md).

#### Step 3 - Configure

Once we have it installed, we have to configure it on your `config.php` file. You can choose which one (backend, frontend or common).
```php 
'modules' => [
    'installer' => [
        'class' => \weblogic\installer\Module::class,
        // ...other config settings
        // 'poweredByWebsite' => 'https://www.weblogiconline.eu',
        // 'poweredByName' => 'Weblogic',
    ],
]
```

config settings can be found under [configuration](configuration/settings.md)

A few files need to be adapted:

##### main-local.php
Add the following attribute to the main-local.php (remove them from main.php in located in there)
 - name (application name)
 - timeZone (timezone of the application)
 - db settings
 ```php 
 'components' => [
     'db' => [
         'class' => 'yii\db\Connection',
         'dsn' => 'mysql:host=localhost;dbname=',
         'username' => '',
         'password' => '',
         'charset' => 'utf8',
     ],
 ]
 ```
 - mailer settings concerning transport
 ```php 
 'components' => [
     'mailer' => [
         'transport' => [
             'class' => Swift_SmtpTransport::class,
             'host' => '',
             'username' => '',
             'password' => '',
             'port' => '',
             'encryption' => '',
         ],
     ],
 ]
 ```
 
##### params.php
Adapt to file to have a reference to the local files so the installer can adapt those.
 
```php 
 return [
    'dynamicConfigFile' => dirname(__FILE__) . '/main-local.php',
    'dynamicParamsFile' => dirname(__FILE__) . '/params-local.php'
 ]
```
 
 ##### params-local.php
Add the following attribute to the params-local.php (remove them from params.php in located in there)
  
```php 
  return [
    'supportEmail' => 'it@shinbugent.be',
    'supportName' => 'Shinbu Gent IT team',
    'installed' => false,
  ]
```
 
The last parameter indicated if the application is installed and will be set to true when installed. If you want to redo the installation just set this paramter to false to be able to run the installer.
 
#### Step 4 - Use the installer
Visit the url `%projecturl%/installer/install` to start the installation.