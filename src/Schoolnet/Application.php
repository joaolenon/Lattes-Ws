<?php

namespace Schoolnet;

use Silex\Application as SilexApp;

class Application
{
	public function init()
	{
		$app = new SilexApp();

		$this->configRoutes($app);

		$app->run();
	}

	public function configRoutes($app)
	{
		$configFile = file_get_contents(ROOT_PATH.DS.'config'.DS.'routes.json');
		$routes = json_decode($configFile);

		foreach ($routes as $route) {
		 	$app->get($route->path, $route->target);
		}
	}
}
