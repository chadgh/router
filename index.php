<?php

require_once 'Router.class.php';

// Create the routes we want to use
$routes = array(
	/* /app/[command]  */
	'#^/app/([^/]+)/?$#' => array('Handlers', 'appHandler'),
	/* /2011/06/06/[slug-of-post]/	*/
	'#^/(\d\d\d\d)/(\d\d)/(\d\d)/([^/]+)/?$#' => 'Handlers::blogPostHandler'
);

//
$router = new Router('defaultHandler');

// Do the routing. It'll go through the $routes array and check each regex against the string in $url, executing the first handler that matches. (Failing that, it'll execute the default handler.)
$router->route($routes);

// I've put the handlers into a class like this, but you can organize them however you like
class Handlers {
	public static function blogPostHandler($args) {
		// $args is an array of the captured groups from the regex
		$year = $args[0];
		$month = $args[1];
		$day = $args[2];
		$slug = $args[3];

		echo "Blog: $month/$day/$year, slug=$slug.";
	}

	public function appHandler($args) {
		$slug = $arsgs[0];

		echo "App: slug=$slug";
	}
}

// This one's to demonstrate a handler that isn't in a class
function defaultHandler() {
	echo "Default.";
}

?>
