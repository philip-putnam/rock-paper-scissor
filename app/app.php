<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/RockPaperScissors.php';

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    session_start();

    if (empty($_SESSION['games'])) {
        $_SESSION['games'] = array();
    };

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        $_SESSION['games'] = array();
        return $app["twig"]->render("index.html.twig");
    });

    $app->get('/player-one', function() use ($app) {
        return $app["twig"]->render("player-one.html.twig");
    });

    $app->post('/player-two', function() use ($app) {
        $player1Data = new RockPaperScissors($_POST['player_one_choice']);
        $player1Data->save();
        return $app["twig"]->render("player-two.html.twig");
    });

    $app->post('/results', function() use ($app) {
        $player2Data = new RockPaperScissors($_POST['player_two_choice']);
        $player2Data->save();
        $players = RockPaperScissors::getAll();
        $results = $player2Data->playGame($players[0]->getPlayerChoice(), $player2Data->getPlayerChoice());
        return $app["twig"]->render("results.html.twig", array('results' => $results));
    });

    return $app;
?>
