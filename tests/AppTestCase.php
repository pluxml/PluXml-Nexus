<?php

namespace Tests;

use App\Services\PdoService;
use DI\Container;
use PHPUnit\Framework\TestCase;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Views\PhpRenderer;

abstract class AppTestCase extends TestCase
{
    /** @var \Slim\App */
    protected $app;

    /** @var \PDO */
    protected $pdo;

    protected function setUp(): void
    {
        $_SESSION = [];

        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec(file_get_contents(__DIR__ . '/schema.sql'));

        $statement = $this->pdo->prepare(
            'INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)'
        );
        $statement->execute([
            'ciadmin',
            password_hash('Test1234!', PASSWORD_BCRYPT),
            'ci@example.test',
            'admin',
        ]);

        $container = new Container();
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        $container->set('router', static fn () => $app->getRouteCollector()->getRouteParser());
        $container->set('csrf', static function () use ($app) {
            // Array storage keeps the Guard independent from PHP sessions,
            // which also makes the tests deterministic on PHP 8.4/8.5.
            $storage = [];

            return new Guard($app->getResponseFactory(), 'csrf', $storage);
        });
        $container->set('view', static function () {
            $view = new PhpRenderer(dirname(__DIR__) . '/views');
            $view->setLayout('layout.php');

            return $view;
        });
        $container->set('pdo', fn () => new PdoService($this->pdo));
        $container->set('flash', static fn () => new Messages());
        $container->set('mail', static fn () => new class {
            public function sendMail(): bool
            {
                return true;
            }
        });

        require dirname(__DIR__) . '/config/middlewares.php';
        require dirname(__DIR__) . '/config/routes.php';

        $this->app = $app;
    }

    protected function request(string $method, string $path, array $parsedBody = [])
    {
        $request = (new ServerRequestFactory())->createServerRequest($method, $path);

        if ($parsedBody !== []) {
            $request = $request->withParsedBody($parsedBody);
        }

        return $this->app->handle($request);
    }
}
