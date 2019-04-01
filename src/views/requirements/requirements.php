<?php
/**
 * @var $summary array Array containing the summary of the check:
 *      'total' => total number of checks,
 *      'errors' => number of errors,
 *      'warnings' => number of warnings,
 * @var $requirements array Contains all requirements and the result of the check:
 *      'name' => name of the requirement,
 *      'mandatory' => is mandatory,
 *      'condition' => condition,
 *      'by' => required by feature,
 *      'memo' => description,
 *      'error' => is there an error,
 *      'warning' => is there a warning,
 */
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center"><?= Yii::t('installerSystemCheck', 'System Check') ?></h2>
	</div>

	<div class="panel-body">
		<h3><?= Yii::t('installerGeneral', 'Description') ?></h3>
		<p>
            <?= Yii::t('installerSystemCheck', 'This script checks if your server configuration meets the requirements for running the  application. 
            It checks if the server is running the right version of PHP, if appropriate PHP extensions have been loaded, and if php.ini file settings are correct.') ?>
		</p>
		<p>
            <?= Yii::t('installerSystemCheck', 'There are two kinds of requirements being checked. Mandatory requirements are those that have to be met to allow the application to work as expected. <br />
			There are also some optional requirements being checked which will show you a warning when they do not meet. Functionality may not be available when the optional requirements aren\'t met.') ?>
		</p>

		<h3><?= Yii::t('installerSystemCheck', 'Conclusion') ?></h3>
		<?php use yii\helpers\Html;

		if ($summary['errors'] > 0): ?>
			<div class="alert alert-danger">
				<strong><?= Yii::t('installerSystemCheck', 'Unfortunately your server configuration does not satisfy the requirements by this application.<br />Please refer to the table below for detailed explanation.') ?></strong>
			</div>
		<?php elseif ($summary['warnings'] > 0): ?>
			<div class="alert alert-info">
				<strong><?= Yii::t('installerSystemCheck', 'Your server configuration satisfies the minimum requirements by this application.<br />Please pay attention to the warnings listed below and check if your application will use the corresponding features.') ?></strong>
			</div>
		<?php else: ?>
			<div class="alert alert-success">
				<strong><?= Yii::t('installerSystemCheck', 'Congratulations! Your server configuration satisfies all requirements.') ?></strong>
			</div>
		<?php endif; ?>

		<h3><?= Yii::t('installerSystemCheck', 'Details') ?></h3>

		<table class="table table-bordered">
			<tr><th><?= Yii::t('installerSystemCheck', 'Name') ?></th><th><?= Yii::t('installerSystemCheck', 'Result') ?></th><th><?= Yii::t('installerSystemCheck', 'Required By') ?></th><th><?= Yii::t('installerSystemCheck', 'Memo') ?></th></tr>
			<?php foreach ($requirements as $requirement): ?>
				<tr class="<?php echo $requirement['condition'] ? 'success' : ($requirement['mandatory'] ? 'danger' : 'warning') ?>">
					<td>
						<?php echo $requirement['name'] ?>
					</td>
					<td>
						<span class="result"><?php echo $requirement['condition'] ? Yii::t('installerSystemCheck','Passed') : ($requirement['mandatory'] ? Yii::t('installerSystemCheck','Failed') : Yii::t('installerSystemCheck','Warning')) ?></span>
					</td>
					<td>
						<?php echo $requirement['by'] ?>
					</td>
					<td>
						<?php echo $requirement['memo'] ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>

		<?php if ($summary['errors'] === 0): ?>
            <div>
				<?= Html::a(Yii::t('installerGeneral','Next') . ' <i class="far fa-arrow-alt-circle-right"></i>', ['requirements/finish'], ['class' => 'btn btn-primary', 'style'=>'float: right']) ?>
			</div>
		<?php else: ?>
			<div class="alert alert-danger">
				<strong><?= Yii::t('installerSystemCheck', 'Cannot continue until the requirements are met. Please contact your IT responsible.') ?></strong>
			</div>
		<?php endif; ?>
	</div>
</div>
