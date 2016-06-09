<?php
declare(strict_types = 1);

namespace RadekDvorak\SuperWatcher;

use Dotenv\Dotenv;
use Kdyby\Console\Application;
use Nette\Configurator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tracy\Debugger;



if (!$loader = include __DIR__ . '/../../../vendor/autoload.php') {
    echo 'You must set up the project dependencies.', PHP_EOL;
    exit(1);
}

$paths = [
    'resourcesDir' => __DIR__ . '/../resources',
    'tempDir' => sys_get_temp_dir(),
    'rootDir' => __DIR__ . '/../../..',
];
$main = function (array $paths) {

    $tempDir = $paths['tempDir'] . '/super-watcher';
    @mkdir($tempDir, 0777, true);

    $dotEnv = new Dotenv($paths['rootDir']);
    $dotEnv->load();
    $dotEnv->required('JIRA_HOST')->notEmpty();
    $dotEnv->required('JIRA_USER')->notEmpty();
    $dotEnv->required('JIRA_PASS')->notEmpty();
    $dotEnv->required('MAIL_FROM_NAME')->notEmpty();
    $dotEnv->required('MAIL_FROM_ADDRESS')->notEmpty();
    $dotEnv->required('MAIL_TO_NAME')->notEmpty();
    $dotEnv->required('MAIL_TO_ADDRESS')->notEmpty();
    $dotEnv->required('SMTP_HOST')->notEmpty();
    $dotEnv->required('SMTP_PORT')->notEmpty();

    Debugger::$strictMode = true;
    Debugger::enable(Debugger::DEVELOPMENT);

    $configurator = new Configurator;
    $configurator->setDebugMode(!Debugger::$productionMode);
    $configurator->setTempDirectory($tempDir);
    $configurator->addParameters($paths);
    $configurator->addConfig($paths['resourcesDir'] . '/config.neon');
    $container = $configurator->createContainer();


    /** @var Application $application */
    $application = $container->getByType(Application::class);
    $application->setAutoExit(true);
    $input = $container->getByType(InputInterface::class);
    $output = $container->getByType(OutputInterface::class);
    $application->run($input, $output);
};

call_user_func($main, $paths);
