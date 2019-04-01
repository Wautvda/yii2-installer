<?php
/**
 * @var $model \weblogic\installer\models\MailerSettings
 */

use yii\helpers\Html;
use yii\widgets\DetailView; ?>

<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerMailer','Mailer Configuration') ?></h2>
	</div>
	<div class="panel-body">
        <h3><?= Yii::t('installerGeneral', 'Description') ?></h3>
		<p><?= Yii::t('installerMailer','These are the current mail details. If you’re not sure about these, please contact your administrator or web host.') ?></p>

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'host',
				'username',
				'port',
				'encryption',
                'from_email',
                'from_name'
			],
		]) ?>

		<div>
			<?= Html::a(Yii::t('installerGeneral','Edit'), ['mailer/setup'], ['class' => 'btn btn-primary']) ?>
			<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['user/index'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
		</div>
	</div>
</div>