TaskCollection = Backbone.Collection.extend({
	model: Task,
	url: TodoApp.serverUrl + 'task/'
});