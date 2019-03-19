<?php

return [

	'extension'    => '.tpl',
	'templates'    => MAKO_APPLICATION_PATH . '/resources/views',
	'compilations' => MAKO_APPLICATION_PATH . '/storage/cache/brio',

	'options' => [
		//'disable_methods' => false,
		//'disable_funcs'   => false,
		'auto_reload'     => true,
		//'force_compile'   => false,
		//'disable_cache'   => false,
		'force_include'   => true,
		//'auto_escape'     => false,
		//'force_verify'    => false,
		//'strip'           => false,
	],

];
