# Router

Router is a (very) small PHP library for doing URL routing.

## Installation

1. Copy `Router.class.php` somewhere in your project directory.
2. Include it (via `require_once` or `include`).
3. Put the code from the `htaccess` section into your `.htaccess` file (or rename the included `htaccess` file to `.htaccess`):
4. Modify `index.php` as necessary.

## htaccess

	RewriteEngine On<br/>
	RewriteCond %{REQUEST_FILENAME} !-f<br/>
	RewriteCond %{REQUEST_FILENAME} !-d<br/>
	RewriteRule . /index.php	[L]

## Usage

Usage looks like this:

	$routes = array(
		'#^/app/([^/]+)/?$#' => 'appHandler',
		'#^/(\d\d\d\d)/(\d\d)/(\d\d)/([^/]+)/?$#' => 'blogHandler'
	);

We've set up the array of handlers, using `#` as our regex delimiter so we don't have to escape forward slashes. The value part of each pair is the name of the handler function you want called when the associated regex matches the URL. You can use global function names, static methods in a class, or pass in an array with the object and method to be called. For example:

	$routes = array(
		'#^/app/([^/]+)/?$#' => array('Handler', 'appHandler'),
		'#^/(\d\d\d\d)/(\d\d)/(\d\d)/([^/]+)/?$#' => 'blogHandler'
	);

The instantiated objects can also be passed a third element of the array with will be used as the parameters to be passed to the constructor. Previously instantiated object can also be passed in.

	$router->route($routes);

This does the routing. You pass in the array of routes and the matching method/function is called (or an exception is thrown).

A working example is in the included `index.php` file.
