Migration setup
==============

To fully use the power f the setup, your migrations need to be configured in the file `%PROJECT_DIR%/console/config/main.php`.

When installing extensions that need to do migrations, the best way to never forget to execute them (through console) is to add them in the main.php config file in console config.
The example includes [yii2-usuario](https://github.com/2amigos/yii2-usuario) en the default RBAC from yii2.

```php
return [
    // ...
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations',
            ],
            'migrationNamespaces' => [
                'Da\User\Migration',
            ],
        ],
    ],
    // ...
];
```
This basically instructs your application to always try to use migrations from the given namespace. Which again
is very convenient way to track new migration classes coming from this and possibly other extensions and sources. 