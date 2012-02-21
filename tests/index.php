<?php
include('../Router.class.php');

function defaultHandler($params) {
	echo '<br>';
	echo json_encode($params);
	echo '<br>';
}

function handlerFunction1($params) {
	echo '<br>handler1<br>';
}

class Point {
	public $x;
	public $y;

	function Point($point=array(0,0)) {
		$this->x = $point[0];
		$this->y = $point[1];
	}

	function toString() {
		echo '<br>x:' . $this->x . ', y:' . $this->y . '<br>';
	}

	function handle($params) {
		echo json_encode($params);
	}
}

echo '<pre>';
print_r($_SERVER);
echo '</pre>';
$routes = array(
	"#(test1)#" => "handlerFunction1",
	"#(test2)#" => array("Point", "toString"),
	"#(test3)#" => array("Point", "toString", array(42, 42)),
	"#(test4)#" => array(new Point(array(1,2)), "toString"),
	"#(testing)#" => array("Point", "handle", array(3,3)),
);

$router = new Router('defaultHandler');
$router->route($routes, "test1");
$router->route($routes, "test2");
$router->route($routes, "test3");
$router->route($routes, "test4");
$router->route($routes, "testing");
$router->route($routes, "");
?>
