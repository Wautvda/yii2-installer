Configuration Options
=====================

The module comes with a set of attributes to configure. The following is the list of all available options: 

#### poweredByWebsite (type: `string`, default: `https://www.weblogiconline.eu`)
Setting this attribute will allow users to configure their login process with two-factor authentication. 

#### poweredByName (type: `string`, default: `Weblogic`)
Setting this attribute will allow users to configure their login process with two-factor authentication. 

#### executeMigrations (type: `bool`, default: `true`)
Executes migration as long as the migration configuration is ok (see [migrations](../installation/migrations.md))

#### addAdminUser (type: `bool`, default: `true`)
Adds a administrator user. This is helpful when using yii2-usuario or yii2-user as user administration packages(see [user requirements](../installation/user.md))

### addAdminUserDefaultRole (type: `string`, default: `Admin`)
The default filled in role when adding a user.
