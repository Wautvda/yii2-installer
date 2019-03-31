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

        <div>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['requirements/index'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
        </div>
    </div>


</div>