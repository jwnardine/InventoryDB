<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('form.html.twig', array('items' => Inventory::getAll()));
    });

    $app->post("/results", function() use ($app) {
        $my_Inventory = new Inventory($_POST['items']);
        $my_Inventory->save();
        var_dump($my_Inventory);
        return $app['twig']->render('results.html.twig', array('items' => Inventory::getAll()));
    });





    return $app;
 ?>
