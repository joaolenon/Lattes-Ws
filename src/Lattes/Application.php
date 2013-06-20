<?php

namespace Lattes;

use Respect\Rest\Router;

class Application
{
	public function init()
	{
		$app = new Router();
		$this->configRoutes($app);
		$app->run();
	}

	private function configRoutes($app)
	{
		$configFile = file_get_contents(ROOT_PATH.DS.'config'.DS.'routes.json');
		$routes = json_decode($configFile);

		foreach ($routes as $route) {
			$method = $route->method;
		 	$app->$method($route->path, $route->target)->accept(array(
		 		'text/html' => function($data) {
		 			echo $this->twig()->render($data['view'].'.html', $data);
		 			return;
		 		},
		 		'text/xml' => function($data) {
		 			echo $this->twig()->render($data['view'].'.xml', $data);
		 			return;
		 		},
		 		'application/json' => function($data) {
		 			unset($data['view']);
		 			echo json_encode($data);
		 			return;
		 		}
		 	));
		}
	}

	private function twig()
	{
		\Twig_Autoloader::register();
		$loader = new \Twig_Loader_Filesystem(ROOT_PATH.DS.'views'.DS);
		$twig = new \Twig_Environment($loader);

		return $twig;
	}
}
