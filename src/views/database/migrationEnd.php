<?php

use yii\helpers\Html;

?>
<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerDatabase','Database Configuration') ?></h2>
	</div>
	<div class="panel-body">
		<p><?= Yii::t('installerDatabase','Migration succesfull!') ?></p>

		<div>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['mailer/index'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
		</div>
	</div>
</div>