<?php
$properties = array();

$tmp = array(
	'jsSources' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'cssSources' => array(
		'type' => 'textfield',
		'value' => '',
	),

	'minifyJs' => array(
		'type' => 'combo-boolean',
		'value' => false
	),
	'minifyCss' => array(
		'type' => 'combo-boolean',
		'value' => false
	),


	'jsFilename' => array(
		'type' => 'textfield',
		'value' => 'scripts',
	),
	'cssFilename' => array(
		'type' => 'textfield',
		'value' => 'styles',
	),

	'cacheFolder' => array(
		'type' => 'textfield',
		'value' => '/assets/components/minifyx/cache/',
	),
	'forceUpdate' => array(
		'type' => 'combo-boolean',
		'value' => false,
	),

	'registerJs' => array(
		'type' => 'list',
		'value' => 'placeholder',
		'options' => array(
			array('name' => 'Placeholder', 'value' => 'placeholder'),
			array('name' => 'Startup script', 'value' => 'startup'),
			array('name' => 'Default', 'value' => 'default'),
		)
	),
	'jsPlaceholder' => array(
		'type' => 'textfield',
		'value' => 'MinifyX.javascript',
	),
	'registerCss' => array(
		'type' => 'list',
		'value' => 'placeholder',
		'options' => array(
			array('name' => 'Placeholder', 'value' => 'placeholder'),
			array('name' => 'Default', 'value' => 'default'),
		)
	),
	'cssPlaceholder' => array(
		'type' => 'textfield',
		'value' => 'MinifyX.css',
	),

);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;
