<?php
/**
 * Used for creating the database schema
 */

$app->get('/install', function () use ($db) {
    $db->exec('  CREATE TABLE IF NOT EXISTS projects (
                    project_id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    name TEXT);');

    $db->exec('  CREATE TABLE IF NOT EXISTS tasks (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    project_id_ref INTEGER NOT NULL CONSTRAINT `projectId_taskId` REFERENCES projects ( project_id ) ON UPDATE CASCADE ON DELETE CASCADE,
                    name TEXT ,
                    date_created INTEGER ,
                    date_due INTEGER ,
                    status INTEGER);');
    
    echo 'OK';
});
