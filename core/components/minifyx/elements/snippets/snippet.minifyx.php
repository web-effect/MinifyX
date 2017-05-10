<?php
/** @var array $scriptProperties */
if (!$modx->getService('minifyx','MinifyX', MODX_CORE_PATH.'components/minifyx/model/minifyx/')) {return;}
/** @var MinifyX $MinifyX */
$MinifyX = new MinifyX($modx, $scriptProperties);
if (!$MinifyX->prepareCacheFolder()) {
	$modx->log(modX::LOG_LEVEL_ERROR, '[MinifyX] Could not create cache dir "'.$MinifyX->config['cacheFolder'].'"');
	return;
}
$cacheFolderUrl = MODX_BASE_URL . str_replace(MODX_BASE_PATH, '', $MinifyX->config['cacheFolder']);

$array = array(
	'js' => trim($modx->getOption('jsSources', $scriptProperties, '', true)),
	'css' => trim($modx->getOption('cssSources', $scriptProperties, '', true)),
);
$registered_scripts=['jscripts','sjscripts'];
$inline_scripts=['js'=>[],'css'=>[]];
foreach($registered_scripts as $skey)
{
	foreach($modx->$skey as $i=>$jsscript)
	{
		if(preg_match('/<(?:link|script).*?(?:href|src)=[\'|"](.*?)[\'|"]/', $jsscript, $tmp)){
			if (strpos($tmp[1], '.css') !== false){$array['css'].=','.$tmp[1];unset($modx->$skey[$i]);}
			if (strpos($tmp[1], '.js') !== false){$array['js'].=','.$tmp[1];unset($modx->$skey[$i]);}
		}
		else
		{
			$type = false;
			if(strpos($jsscript, '<style') !== false)$type='css';
			if(strpos($jsscript, '<script') !== false)$type='js';
			if($type)
			{
				$inline_scripts[$skey][]=$jsscript;
				unset($modx->$skey[$i]);
			}
		}
	}
}


foreach ($array as $type => $value) {
	if (empty($value)) {continue;}
	$filename = $MinifyX->config[$type.'Filename'] . '_';
	$extension = $MinifyX->config[$type.'Ext'];
	$register = $MinifyX->config['register'.ucfirst($type)];
	$placeholder = !empty($MinifyX->config[$type.'Placeholder'])
		? $MinifyX->config[$type.'Placeholder']
		: '';

	$files = $MinifyX->prepareFiles($value);
	$properties = array(
		'minify' => $MinifyX->config['minify'.ucfirst($type)]
				? 'true'
				: 'false',
	);

	$result = $MinifyX->Munee($files, $properties);
	$file = $MinifyX->saveFile($result, $filename, $extension);

	// Register file on frontend
	if (!empty($file) && file_exists($MinifyX->config['cacheFolder'] . $file)) {
		if ($register == 'placeholder' && $placeholder) {
			$tag = $type == 'css'
				? '<link rel="stylesheet" href="' . $cacheFolderUrl .  $file . '" type="text/css" />'
				: '<script type="text/javascript" src="' . $cacheFolderUrl . $file . '"></script>';
			$modx->setPlaceholder($placeholder, $tag);
		}
		else {
			if ($type == 'css') {
				$modx->regClientCSS($cacheFolderUrl . $file);
			}
			else {
				if ($register == 'startup') {
					$modx->regClientStartupScript($cacheFolderUrl . $file);
				}
				else {
					$modx->regClientScript($cacheFolderUrl . $file);
				}
			}
		}
	}
}


foreach($inline_scripts as $skey=>$scripts)
{
	foreach($scripts as $script)
	{
		$modx->$skey[]=$script;
	}
}
return;
