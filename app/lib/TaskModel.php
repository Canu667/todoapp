<?php
namespace todoapp;

class TaskModel {
    
    public function  getTask($taskId) {
        $sth = $this->db->prepare('SELECT * FROM tasks WHERE id = ?;');
        $sth->execute([intval($taskId)]);
        return $sth->fetchAll(\PDO::FETCH_CLASS);
    }
    
    public function  updateTask($task) {
        $sth = $this->db->prepare('UPDATE tasks SET project_id_ref = ?, name = ?, date_created =?, date_due = ?, status =? WHERE id = ?;');
        
        $sth->execute([
             $task['project_id_ref'],
             $task['name'],
             $task['date_created'],
             $task['date_due'],
             $task['status'],
             $task['id'],
                 ]); 
        
        return $this;
    }
    
    public function  insertTask($task) {
        $sth = $this->db->prepare('INSERT INTO tasks (project_id_ref, name, date_created, date_due, status) VALUES (?, ?, ?, ?, ?);');

        $sth->execute([
            $task['project_id_ref'],
            $task['name'],
            $task['date_created'],
            $task['date_due'],
            $task['status'],
        ]);

        return $this->db->lastInsertId();
    }
    
    public function  removeTask($taskId){
        $sth = $this->db->prepare('DELETE FROM tasks WHERE id = ?;');
        $sth->execute([
            $taskId,
        ]); 
    }
    
    public function  getTasksByProject($projectId, $taskId) {
        $sth = $this->db->prepare('SELECT * FROM tasks WHERE project_id_ref = ? and id = ?;');
        $sth->execute([intval($projectId), intval($taskId)]);  
        return $sth->fetchAll(\PDO::FETCH_CLASS);
    }
    
}
