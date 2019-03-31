<?php

use yii\helpers\Html;

?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerSettings','Settings Configuration') ?></h2>
	</div>
	<div class="panel-body text-center">
		<p class="lead"><?= Yii::t('installerSettings','<strong>Congratulations!</strong> You\'re done.') ?></p>

		<p><?= Yii::t('installerSettings','The installation completed successfully! Have fun with {0}.', [yii::$app->name]) ?></p>

		<div class="text-center">
			<br/>
			<?= Html::a(Yii::t('installerSettings','Go to website'), Yii::$app->urlManager->createUrl('//site/index'), ['class' => 'btn btn-success']) ?>
		</div>
	</div>
</div>