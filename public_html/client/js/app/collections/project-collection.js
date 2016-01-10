ProjectCollection = Backbone.Collection.extend({
	model: Project,
	url: TodoApp.serverUrl + 'project/' 
});