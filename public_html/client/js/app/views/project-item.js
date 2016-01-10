/*
 * View for single project item
 */
ProjectItem = Backbone.View.extend({

	tagName: 'li',

	initialize: function() {
		this.render = _.bind(this.render, this);

		this.template = _.template($('#project-item').html());

		this.model.bind('change', this.render);
	},

	events: {
		'dblclick a': 'edit',
		'click a': 'loadTasks'
	},

	render: function() {
		this.$el.html(this.template(this.model.attributes));
		return this;
	},

	edit: function() {
		new ProjectDialog({model: this.model}).show();
	},

	loadTasks: function() {
		TodoApp.$projects.find('li.active').removeClass('active');
		this.$el.addClass('active');

		$('#project-title span').html(this.model.get('name'));

		TodoApp.$tasks.empty();

		TodoApp.tasks = new TaskCollection();
		TodoApp.currentProjectId = this.model.get('project_id');

		TodoApp.tasks.fetch({data: {project: this.model.get('project_id')}, processData: true, success: function() {
			TodoApp.taskListView = new TaskList({
				collection: TodoApp.tasks,
				el: TodoApp.$tasks
			});

			TodoApp.taskListView.render();
		}});
	}
});