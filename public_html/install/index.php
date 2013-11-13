<?php
use umi\dbal\cluster\IDbCluster;
use umi\http\request\IRequest;
use umi\orm\collection\ICollectionManager;
use umi\orm\persister\IObjectPersister;

$appDirectory = realpath(__DIR__ . '/../..');

require $appDirectory . '/init_autoloader.php';

$bootstrapConfigFile = $appDirectory . '/configuration/bootstrap.php';
if (!is_readable($bootstrapConfigFile)) {
    throw new RuntimeException('Invalid bootstrap configuration file.');
}

require $appDirectory . '/Bootstrap.php';
$bootstrap = new Bootstrap(require $bootstrapConfigFile);

require 'common.php';

/** @var IRequest $request */
$request = $bootstrap->getToolkit()
    ->getService('umi\http\request\IRequest');

if ($request->getMethod() == IRequest::METHOD_GET) {
    showHtmlPage("templates/prepare.phtml");
}

/*
 * Get services from toolkit
 */
/** @var IDbCluster $dbCluster */
$dbCluster = $bootstrap->getToolkit()
    ->getService('umi\dbal\cluster\IDbCluster');
$dbDriver = $dbCluster->getMaster()
    ->getDbDriver();
/** @var ICollectionManager $collectionManager */
$collectionManager = $bootstrap->getToolkit()
    ->getService('umi\orm\collection\ICollectionManager');
/** @var IObjectPersister $objectPersister */
$objectPersister = $bootstrap->getToolkit()
    ->getService('umi\orm\persister\IObjectPersister');

$actions = [];

$error = false;
try {
    $actions[] = 'Updating database scheme...';
    require "data/update_scheme.php";
    $actions[] = 'Database scheme updated successfully!';
} catch (Exception $error) {
    $actions[] = ['Cannot upgrade database scheme', (string) $error];
}

if (!$error) {
    try {
        $actions[] = 'Adding database sample data...';
        require "data/update_data.php";
        $actions[] = 'Sample data added successfully!';

    } catch (Exception $error) {
        $actions[] = ['Cannot add data', (string) $error];
    }
}

showHtmlPage('templates/success.phtml');
