User requirements
=================

In order to create a user and RBAC (more info on this can be found on the [yii2 guide](https://www.yiiframework.com/doc/guide/2.0/en/security-authorization)) it is required to install [yii2-usuario](https://github.com/2amigos/yii2-usuario) as user managament.
[Yii2-user from Dektrium](https://github.com/dektrium/yii2-user) is also an option, but development has almost ceased.

The required fields are email, username and role. If the role didn't exist it will be created. 
The password isn't required and will be generated when not provided.


