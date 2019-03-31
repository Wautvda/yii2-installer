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
        <title><?= Html::encode('Setup Wizard') ?></title>
        <?php $this->head() ?>
    </head>
	<body>
	<?php $this->beginBody() ?>
	<div class="container">
		<?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"><?= Yii::t('app', 'Made possible by <a href="https://www.weblogiconline.eu" target="_blank">Weblogic</a>')?>.</p>
        </div>
    </footer>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>