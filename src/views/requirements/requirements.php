<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center">System Check</h2>
	</div>

	<div class="panel-body">
		<h3>Description</h3>
		<p>
			This script checks if your server configuration meets the requirements for running the  application.
			It checks if the server is running the right version of PHP, if appropriate PHP extensions have been loaded, and if php.ini file settings are correct.
		</p>
		<p>
			There are two kinds of requirements being checked. Mandatory requirements are those that have to be met to allow the applocation to work as expected. <br />
			There are also some optional requirements being checked which will show you a warning when they do not meet. Functionality may not be available when the optional requirements aren't met.
		</p>

		<h3>Conclusion</h3>
		<?php use yii\helpers\Html;

		if ($summary['errors'] > 0): ?>
			<div class="alert alert-danger">
				<strong>Unfortunately your server configuration does not satisfy the requirements by this application.<br>Please refer to the table below for detailed explanation.</strong>
			</div>
		<?php elseif ($summary['warnings'] > 0): ?>
			<div class="alert alert-info">
				<strong>Your server configuration satisfies the minimum requirements by this application.<br>Please pay attention to the warnings listed below and check if your application will use the corresponding features.</strong>
			</div>
		<?php else: ?>
			<div class="alert alert-success">
				<strong>Congratulations! Your server configuration satisfies all requirements.</strong>
			</div>
		<?php endif; ?>

		<h3>Details</h3>

		<table class="table table-bordered">
			<tr><th>Name</th><th>Result</th><th>Required By</th><th>Memo</th></tr>
			<?php foreach ($requirements as $requirement): ?>
				<tr class="<?php echo $requirement['condition'] ? 'success' : ($requirement['mandatory'] ? 'danger' : 'warning') ?>">
					<td>
						<?php echo $requirement['name'] ?>
					</td>
					<td>
						<span class="result"><?php echo $requirement['condition'] ? 'Passed' : ($requirement['mandatory'] ? 'Failed' : 'Warning') ?></span>
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
			<div class="text-center">
				<?= Html::a("Next" . ' <i class="fa fa-arrow-circle-right"></i>', ['database/index'], ['class' => 'btn btn-lg btn-primary']) ?>
			</div>
		<?php else: ?>
			<div class="alert alert-danger">
				<strong>Cannot continue until the requirements are met. Please contact your IT responsible.</strong>
			</div>
		<?php endif; ?>
	</div>
</div>
