<?php

require_once 'bootstrap.php';

use Respect\Relational\Mapper;
use Respect\Relational\Sql;
use Lattes\Crawler;

try {
    $sql = 'TRUNCATE production;';
    $sql .= 'TRUNCATE titulation;';
    $sql .= 'TRUNCATE professional;';
    $pdo->exec($sql);

    $mapper     = new Mapper($pdo);
    $users   = $mapper->user->fetchAll();

    foreach ($users as $user) {
        $crawler = new Crawler($user->lattes);
        $crawler->execute();

        $educationalCollection = $crawler->educationalBackground->data;

        foreach ($educationalCollection as $educational) {
            $educational = (object) $educational;

            if ($educational->end == 0)
                unset($educational->end);

            $educational->user_id = $user->id;

            $mapper->titulation->persist($educational);
            $mapper->flush();
        }

        $professionalCollection = $crawler->professional->data;

        foreach ($professionalCollection as $professional) {
            $professional = (object) $professional;

            if ($professional->end == 0)
                $professional->end = 9999;

           $professional->user_id = $user->id;

            $mapper->professional->persist($professional);
            $mapper->flush();
        }

        $educational = $mapper->titulation(array('end IS NOT NULL', 'user_id' => $user->id))
            ->fetch(Sql::orderBy('titulation.weight')->desc());

        $productionsCollection = $crawler->productions->data;

        foreach ($productionsCollection as $production) {
            $production = (object) $production;

            $production->user_id = $user->id;

            $mapper->production->persist($production);
            $mapper->flush();
        }

        $user->max_titulation = $educational->type;
        
        $mapper->user->persist($user);
        $mapper->flush();
    }
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
