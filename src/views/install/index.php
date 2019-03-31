<?php

use yii\helpers\Html;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="text-center">Setup Wizard</h2>
    </div>

    <div class="panel-body  text-center">

        <p class="lead"><strong>Welcome to the installation wizard</p>

        <p>This wizard will install and configure your application.<br><br>To continue, click Next.</p>

        <div class="text-center">
			<?= Html::a("Next" . ' <i class="fa fa-arrow-circle-right"></i>', ['requirements/index'], ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>


</div>