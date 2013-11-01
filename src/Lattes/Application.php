<?php

namespace Lattes;

use Pdo;
use Respect\Rest\Router;
use Respect\Relational\Mapper;

class Application
{
	private $router;

	public function init()
	{
		$this->router = new Router();
		$this->configRoutes();
		$this->router->run();
	}

	private function parseJsonConfig($file = 'config')
	{
		$file = ROOT_PATH.DS.'config'.DS.$file.'.json';
		$configFile = file_get_contents($file);

		return json_decode($configFile);
	}

	private function db()
	{
		$dbHost     = getenv('LATTES_DB_HOST') ?: 'localhost';
		$dbUser     = getenv('LATTES_DB_USER') ?: 'root';
		$dbPass     = getenv('LATTES_DB_PASS') ?: '';
		$dbName     = getenv('LATTES_DB_NAME') ?: 'lattes';

		return new Mapper(new Pdo("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass));
	}

	private function configRoutes()
	{
		$routes = $this->parseJsonConfig('routes');

		foreach ($routes as $route) {
			$method = $route->method;
		 	$this->router->$method($route->path, $route->target, array($this->db()))
		 		->accept(array(
			 		'application/json' => function($data) {
			 			echo json_encode($data);
			 			return;
			 		},
		 		));
		}
	}
}
