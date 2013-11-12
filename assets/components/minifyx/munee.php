<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';

define('WEBROOT', MODX_BASE_PATH);
define('MUNEE_CACHE', MODX_CORE_PATH . 'cache/default/munee/');

require_once MODX_CORE_PATH . 'components/minifyx/munee/munee.phar';
echo \Munee\Dispatcher::run(new \Munee\Request());