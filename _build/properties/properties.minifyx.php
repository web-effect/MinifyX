<?php
$properties = array();

$tmp = array(
	'jsSources' => array(
		'xtype' => 'textfield',
		'value' => '',
	),
	'cssSources' => array(
		'xtype' => 'textfield',
		'value' => '',
	),

	'minifyJs' => array(
		'xtype' => 'combo-boolean',
		'value' => false
	),
	'minifyCss' => array(
		'xtype' => 'combo-boolean',
		'value' => false
	),


	'jsFilename' => array(
		'xtype' => 'textfield',
		'value' => 'scripts',
	),
	'cssFilename' => array(
		'xtype' => 'textfield',
		'value' => 'styles',
	),

	'cacheFolder' => array(
		'xtype' => 'textfield',
		'value' => '/assets/components/minifyx/cache/',
	),
	'forceUpdate' => array(
		'xtype' => 'combo-boolean',
		'value' => false,
	),

	'registerJs' => array(
		'xtype' => 'list',
		'value' => 'placeholder',
		'options' => array(
			array('name' => 'Placeholder', 'value' => 'placeholder'),
			array('name' => 'Startup script', 'value' => 'startup'),
			array('name' => 'Default', 'value' => 'default'),
		)
	),
	'jsPlaceholder' => array(
		'xtype' => 'textfield',
		'value' => 'MinifyX.javascript',
	),
	'registerCss' => array(
		'xtype' => 'list',
		'value' => 'placeholder',
		'options' => array(
			array('name' => 'Placeholder', 'value' => 'placeholder'),
			array('name' => 'Default', 'value' => 'default'),
		)
	),
	'cssPlaceholder' => array(
		'xtype' => 'textfield',
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
