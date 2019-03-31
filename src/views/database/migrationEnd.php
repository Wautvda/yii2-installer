<?php

use yii\helpers\Html;

?>
<div id="database-form" class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center">Database Configuration</h2>
	</div>
	<div class="panel-body">
		<p>Migration succesfull!</p>

		<div>
			<?= Html::a("Next" . ' <i class="fa fa-arrow-circle-right"></i>', ['mailer/index'], ['class' => 'btn btn-lg btn-primary']) ?>
		</div>
	</div>
</div>