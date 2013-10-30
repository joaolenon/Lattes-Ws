<?php

require_once 'bootstrap.php';

use Respect\Relational\Mapper;
use Lattes\Crawler;

try {
    $mapper     = new Mapper($pdo);
    $teachers   = $mapper->teacher->fetchAll();

    foreach ($teachers as $teacher) {
        $crawler = new Crawler($teacher->lattes);
        $crawler->execute();

        $educationalCollection = $crawler->educationalBackground->data;

        foreach ($educationalCollection as $educational) {
            $educational = (object) $educational;

            if (empty($educational->end))
                unset($educational->end);

            $educational->teacher_id = $teacher->id;

            $mapper->titulation->persist($educational);
            $mapper->flush();
        }

        $productionsCollection = $crawler->productions->data;

        foreach ($productionsCollection as $production) {
            $production = (object) $production;

            $production->teacher_id = $teacher->id;

            $mapper->production->persist($production);
            $mapper->flush();
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
