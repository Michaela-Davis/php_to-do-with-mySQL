<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Tasks.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('tasks.html.twig', array('tasks' => Tasks::getAll()));
    });

    $app->post("/tasks", function() use ($app) {
        $task = new Tasks($_POST['description']);
        $task->save();
        return $app['twig']->render('create_tasks.html.twig', array('newtask' => $task));
    });

    $app->post("/delete_tasks", function() use ($app) {
        Tasks::deleteAll();
        return $app['twig']->render('delete_tasks.html.twig');
    });

    return $app;
?>
