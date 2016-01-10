/*
 * Project model
 */
Project = Backbone.Model.extend({
	defaults: {
		project_id: null,
		name: ''
	},
	urlRoot: TodoApp.serverUrl + 'project/'
});