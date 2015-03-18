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

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('restaurants.twig', array('cuisine' => $cuisine));
    });

    $app->post("/restaurants", function() use ($app) {
        $name = $_POST['name'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($id, $name, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('index.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getFoodType()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($id = null, $_POST['cuisine']);
        $cuisine->save();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.twig', array('cuisines' => Cuisine::deleteAll()));
    });

    $app->post("/delete_restaurants", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('restaurants.twig', array('restaurants' => Task::deleteAll(), 'cuisines' => Cuisine::getAll()));
    });

    return $app;

?>
