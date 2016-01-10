/*
 * Task list/collection view
 */
TaskList = Backbone.View.extend({
	initialize: function() {
		_(this).bindAll('add');

		this._tasks = [];
		
		this.collection.each(this.add);
		
		this.collection.bind('add', this.add);
	},
        
	render: function() {
		this._rendered = true;
		this.$el.empty();
		_(this._tasks).each(function(item) {
			TodoApp.$tasks.append(item.render().el);
		});
	},
        
	add: function(task) {
		var taskItem = new TaskItem({model: task});

		this._tasks.push(taskItem);

		if (this._rendered) {
			this.$el.append(taskItem.render().el);
		}
	}
});