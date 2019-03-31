<?php

use yii\helpers\Html;

?>
<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerDatabase','Database Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerDatabase','The next step will execute database updates. Do not refresh the page!') ?></p>

		<div>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="fa fa-arrow-circle-right"></i>', ['database/migrate-up'], ['class' => 'btn btn-lg btn-primary']) ?>
		</div>
	</div>
</div>