var TodoApp = TodoApp || {};

TodoApp.$tasks = $('#tasks');
TodoApp.$projects	= $('#projects');
TodoApp.tasks = null;
TodoApp.projects = null;
TodoApp.currentProjectId = null;
TodoApp.projectListView = null;
TodoApp.taskListView = null;
TodoApp.serverUrl = 'http://192.168.56.101:3000/';

//It is good to have today and tomorrow defined when setting up
//defaults for date creating
TodoApp.today = new Date();
TodoApp.tomorrow = new Date();
TodoApp.tomorrow.setDate(TodoApp.today.getDate()+1);

TodoApp.start = function() {
    TodoApp.projects = new ProjectCollection();

    TodoApp.projects.fetch({success: function() {
	TodoApp.projectListView = new ProjectList({
		collection: TodoApp.projects,
		el: TodoApp.$projects
	});
	TodoApp.projectListView.render();

	TodoApp.$projects.find('li:nth-child(2)').find('a').trigger('click');
    }});

    $('#add-project').click(function(e) {
	var view = new ProjectDialog({model: new Project()});
	view.show();
	return false;
    });

    $('#remove-project').click(function(e) {
        var project = TodoApp.projects.find(function(model) { return model.get('project_id') == TodoApp.currentProjectId; });
        project.set('id', TodoApp.currentProjectId);
        project.destroy();

	return false;	
    });

    $('#add-task').click(function(e) {
	var view = new TaskDialog({model: new Task()});
	view.show();
	return false;
    });  
}
