<?php

use weblogic\installer\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name .' | ' . Yii::t('installerGeneral', 'Installation wizard') ?></title>
        <?php $this->head() ?>
    </head>
	<body>
	<?php $this->beginBody() ?>
	<div class="container">
		<?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"><?= Yii::t('installerGeneral', 'Made possible by <a href="{0}" target="_blank">{1}</a>', [Yii::$app->getModule('installer')->poweredByWebsite, Yii::$app->getModule('installer')->poweredByName])?>.</p>
        </div>
    </footer>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>