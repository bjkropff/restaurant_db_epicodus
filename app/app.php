<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $app['debug'] = TRUE;

    $DB = new PDO('pgsql:host=localhost;dbname=places_to_eat');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.twig', array('cuisines'=>Cuisine::getAll()));
    });

    $app->get("/restaurants", function() use ($app){
        return $app['twig']->render('restaurants.twig', array('restaurants'=>Restaurant::getAll()));
    });

    $app->post("/restaurants", function() use ($app) {
        $name = $_POST['name'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($id = null, $name, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('restaurants.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/restaurants", function() use ($app) {
        $restaurant = new Restaurant($_POST['name']);
        $restaurant->save();
        return $app['twig']->render('restaurants.twig', array('restaurants' => Restaurant::getAll()));
    });

    $app->get("/cuisines", function() use ($app) {
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('restaurants.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($id = null, $_POST['food-type']);
        $cuisine->save();
        return $app['twig']->render('index.twig', array('cuisine' => $cuisine, 'restaurants' => Restaurant::getAll(), 'cuisines' => Cuisine::getAll()));
    });

    return $app;

?>
