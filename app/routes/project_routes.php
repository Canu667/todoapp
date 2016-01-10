<?php
/**
 * TODO: push all SQL statements to models
 */
$app->get('/project/[{id}]', function ($request, $response, $args) use ($app, $db, $projectModel) {
    $route = $request->getAttribute('route');
    $projectId = $route->getArgument('id');
    $data = array();
    
    if (!is_null($projectId)) {    
        $data = $projectModel->getTasksByProject($projectId);
    } else {
        $data = $projectModel->getAllProjects();
    }
    
    echo json_encode($data);
});

$app->post('/project/', function ($request, $response, $args) use ($app, $db) {
    $project = $request->getParsedBody();
    
    $sth = $db->prepare('INSERT INTO projects (name) VALUES (?);');
    $sth->execute([
        $project['name'],
    ]);

    $project['id'] = $db->lastInsertId();
    $project['project_id'] = $project['id'];

    echo json_encode($project);
});

$app->put('/project/[{id}]', function ($request, $response, $args) use ($app, $db) {
    $route = $request->getAttribute('route');
    $projectId = $route->getArgument('id');
    
    $sth = $db->prepare('SELECT * FROM projects WHERE project_id = ?;');
    $sth->execute([intval($projectId)]);;  
    $data = $sth->fetchAll(PDO::FETCH_CLASS);
    
    if (count($data) > 0) {
        $project = $request->getParsedBody();
        $sth = $db->prepare('UPDATE projects SET name = ? WHERE project_id = ?;');
        
        $sth->execute([
             $project['name'],
             $project['project_id'],
                 ]);  
        
            $sth = $db->prepare('SELECT * FROM projects WHERE project_id = ?;');
            $sth->execute([$project['project_id']]);
            $data = $sth->fetchAll(PDO::FETCH_CLASS);
    }
    
    echo json_encode($data);
});

$app->delete('/project/[{id}]', function ($request, $response, $args) use ($app, $db) {
    $route = $request->getAttribute('route');
    $projectId = $route->getArgument('id');
    
    $sth = $db->prepare('DELETE FROM projects WHERE project_id = ?;');
    $sth->execute([
        $projectId,
    ]);
    $sth = $db->prepare('SELECT * FROM projects WHERE project_id = ?;');
    $sth->execute([intval($projectId)]);
    $data = $sth->fetchAll(PDO::FETCH_CLASS);

    echo json_encode($data);
});


