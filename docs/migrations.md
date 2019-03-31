Migration setup
==============

To fully use the power f the setup, your migrations need to be configured the correct way.

When installing extensions that need to do migrations, the best way to never forget to execute them (through console) is to add them in the main.php config file in console config.
The example includes [yii2-usuario](https://github.com/2amigos/yii2-usuario) en the default RBAC from yii2.

```
'controllerMap' => [
        ... other maps
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
```
This way all all migrations from the components will be done using the installer.