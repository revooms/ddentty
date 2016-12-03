<?php

require_once 'vendor/autoload.php';

use Faker\Factory as Faker;

$loader = new Twig_Loader_Filesystem('views/');
$twig = new Twig_Environment($loader, array(
    #'cache' => 'cache/',
));

$uuid = rand(1,999999);

$faker = Faker::create('en_GB');
$faker->seed($uuid);
$faker->addProvider(new \Faker\Provider\Profession($faker));

$fakerPerson = Faker::create('en_US');
$fakerPerson->addProvider(new \Faker\Provider\en_US\Company($fakerPerson));

$identity = [
    'uuid' => $uuid,
    'name' => $fakerPerson->name,
    'age' => $fakerPerson->numberBetween(20, 78),
    'profession' => $faker->profession,
    'company' => $fakerPerson->company,
    'origin' => $faker->country,
];

echo $twig->render('index.html', array('identity' => $identity));

