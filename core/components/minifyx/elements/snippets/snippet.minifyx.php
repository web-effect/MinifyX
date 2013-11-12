<?php
/** @var array $scriptProperties */
/** @var MinifyX $MinifyX */
if (!$modx->getService('minifyx','MinifyX', MODX_CORE_PATH.'components/minifyx/model/minifyx/')) {return false;}

$MinifyX = new MinifyX($modx, $scriptProperties);
$MinifyX->minify();