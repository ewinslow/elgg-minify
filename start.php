<?php

function minify_init() {
	//make sure this runs after everyone else is done
	elgg_register_plugin_hook_handler('view', 'all', 'minify_views', 1000);
}

function minify_views($hook, $type, $content, $params) {
	$view = $params['view'];

	if (preg_match("/^js\//", $view)) {
		if (include_once dirname(__FILE__) . '/vendors/min/lib/JSMin.php') {
			return JSMin::minify($content);
		}
	} elseif (preg_match("/^css\//", $view)) {
		if (include_once dirname(__FILE__) . '/vendors/min/lib/CSS.php') {
			return Minify_CSS::minify($content);
		}
	}
}

elgg_register_event_handler('init', 'system', 'minify_init');
