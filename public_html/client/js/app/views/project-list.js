/*
 * View for project list, collection of projects
 */
ProjectList = Backbone.View.extend({
	initialize: function() {
		_(this).bindAll('add', 'remove');

		this._projects = [];
		
		this.collection.each(this.add);

		this.collection.bind('add', this.add);
                this.collection.bind('remove', this.remove);
	},
        
	render: function() {
		this._rendered = true;

		_(this._projects).each(function(item) {
			TodoApp.$projects.append(item.render().el);
		});
	},

	add: function(project) {
		var projectItem = new ProjectItem({model: project});

		this._projects.push(projectItem);

		if (this._rendered) {
			this.$el.append(projectItem.render().el);
		}
	},

	remove: function(project) {

		var view = _(this._projects).select(function(cv) { return cv.model === project; })[0];
		if (this._rendered) {
			$(view.el).remove();
		}

		TodoApp.$projects.find('li:nth-child(2)').find('a').trigger('click');
	}
});