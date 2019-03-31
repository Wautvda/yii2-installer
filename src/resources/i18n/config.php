<?php

return [
	'color' => null,
	'interactive' => true,
	'help' => null,
	'sourcePath' => __DIR__. '/../../../src',
	'messagePath' => __DIR__,
	'languages' => [
		'nl'
	],
	'translator' => 'Yii::t',
	'sort' => true,
	'overwrite' => true,
	'removeUnused' => false,
	'markUnused' => true,
	'only' => ['*.php'],
	'except' => [
		'.svn',
		'.git',
		'.gitignore',
		'.gitkeep',
		'.hgignore',
		'.hgkeep',
	],
	'format' => 'php',
];
