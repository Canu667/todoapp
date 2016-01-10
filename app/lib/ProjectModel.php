<?php
namespace todoapp;

class ProjectModel extends MyModel{
    
    public function getTasksByProject($projectId){
        $sth = $this->db->prepare('SELECT * FROM tasks WHERE project_id_ref = ?;');
        $sth->execute([intval($projectId)]);
        return $sth->fetchAll(\PDO::FETCH_CLASS);
    }
    
    public function getAllProjects() {
        $sth = $this->db->prepare('SELECT * FROM projects;');
        $sth->execute();
    
        return $sth->fetchAll(\PDO::FETCH_CLASS);
    }
    
}
