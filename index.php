<?php
require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new \Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/courses/format/{format}', function($format) use ($app) {
    $courses = array(
        array('slug' => 'sistemas-informacao', 'name' => 'Sistemas de Informação')
    );

    return $app['twig']->render("courses/all.{$format}.twig", array('courses' => $courses));
})->value('format', 'html');

$app->run();
