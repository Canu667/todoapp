<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require '../app/vendor/autoload.php';
require '../app/lib/MyModel.php';
require '../app/lib/TaskModel.php';
require '../app/lib/ProjectModel.php';

$app = new \Slim\App();
$db = new PDO('sqlite:../app/data/todoapp.sqlite3');
$taskModel = new todoapp\TaskModel($db);
$projectModel = new todoapp\ProjectModel($db);

$app->contentType('application/json');
$db->exec( 'PRAGMA foreign_keys = ON;' );

require '../app/routes/project_routes.php';
require '../app/routes/task_routes.php';
require '../app/routes/utility_routes.php';
$app->run();
