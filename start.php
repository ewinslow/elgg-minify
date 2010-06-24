<?php

function minify_init()
{
	//make sure this runs after everyone else is done
	register_plugin_hook('display', 'view', 'minify_views', 1000);
}

function minify_views($hook, $type, $content, $params)
{
	switch($params['view']) {
		case 'js/initialise_elgg':
		case 'js/friendsPickerv1':
			if (include_once('lib/min/lib/JSMin.php')) {
				return JSMin::minify($content);
			}
			break;
		case 'css':
			if (include_once('lib/min/lib/CSS.php')) {
				return Minify_CSS::minify($content);
			}
			break;
	}
}

register_elgg_event_handler('init', 'system', 'minify_init');

?>