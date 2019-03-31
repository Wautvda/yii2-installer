<?php

use yii\helpers\Html;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="text-center"><?= Yii::t('installerInstall','Setup Wizard') ?></h2>
    </div>

    <div class="panel-body  text-center">

        <p class="lead"><strong><?= Yii::t('installerInstall','Welcome to the installation wizard') ?></p>

        <p><?= Yii::t('installerInstall','This wizard will install and configure your application.') ?></p>
        <p><?= Yii::t('installerInstall','To continue, click Next.') ?></p>

        <div class="text-center">
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="fa fa-arrow-circle-right"></i>', ['requirements/index'], ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>


</div>