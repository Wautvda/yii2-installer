<?php

use yii\helpers\Html;

?>
<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerDatabase','Database Configuration') ?></h2>
	</div>
	<div class="panel-body">
        <h3><?= Yii::t('installerGeneral', 'Warning') ?></h3>
        <div class="alert alert-danger">
            <?= Yii::t('installerDatabase','The next step will execute database updates. Do not refresh the page!') ?>
        </div>

		<div>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['database/migrate-up'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
		</div>
	</div>
</div>