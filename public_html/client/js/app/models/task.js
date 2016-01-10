/*
 * Task model
 */
Task = Backbone.Model.extend({
	defaults: {
		id: null,
		date_created: TodoApp.today.getFullYear() + '-' + (1 + TodoApp.today.getMonth()) + '-' + TodoApp.today.getDate() + ' ' + TodoApp.today.getHours() + ':' + TodoApp.today.getMinutes() + ':' + TodoApp.today.getSeconds(),
		date_due: TodoApp.tomorrow.getFullYear() + '-' + (1 + TodoApp.tomorrow.getMonth()) + '-' + TodoApp.tomorrow.getDate() + ' ' + TodoApp.tomorrow.getHours() + ':' + TodoApp.tomorrow.getMinutes() + ':' + TodoApp.tomorrow.getSeconds(),
		project_id_ref : null,
		status: 0,
		name: ''
	},
	urlRoot: TodoApp.serverUrl + 'task/'
});