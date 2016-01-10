<?php
$app->get('/task/[{id}]', function ($request, $response, $args) use ($app, $db, $taskModel, $projectModel) {
    $route = $request->getAttribute('route');
    $taskId = $route->getArgument('id');
    $projectId = $request->getQueryParams()['project'];
    $data = null;
    
    if (is_null($taskId)) {   
        $data = $projectModel->getTasksByProject($projectId);
    } else {
        $data = $taskModel->getTasksByProject($projectId, $taskId); 
    }
    
    echo json_encode($data);
});

$app->post('/task/', function ($request, $response, $args) use ($app, $db, $taskModel) {
    $task = $request->getParsedBody();
  
    $task['id'] = $taskModel->insertTask($task);

    echo json_encode($task);
});

$app->put('/task/[{id}]', function ($request, $response, $args) use ($app, $db, $taskModel) {
    $route = $request->getAttribute('route');
    $taskId = $route->getArgument('id');
    
    $data = $taskModel->getTask($taskId);
    
    if (count($data) > 0) {
        $task = $request->getParsedBody();
        $data = $taskModel->updateTask($task)->getTask($taskId);;
    }
    
    echo json_encode($data);
});

$app->delete('/task/[{id}]', function ($request, $response, $args) use ($app, $db, $taskModel) {
    $route = $request->getAttribute('route');
    $taskId = $route->getArgument('id');
    
    $data = $taskModel->getTask($taskId);
    
    if (count($data) > 0) {
        $taskModel->removeTask($taskId);  
    }
    echo json_encode(null);
});
