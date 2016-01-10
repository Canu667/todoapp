/*
 * Single task view
 */
TaskItem = Backbone.View.extend({
	tagName: 'tr',
        
	initialize: function() {
		this.render = _.bind(this.render, this);
		this.template = _.template($('#task-item').html());
		this.model.bind('change', this.render);
	},
        
	events: {
		'dblclick': 'edit',
		'change input': 'modify',
		'click a.delete-action': 'delete'
	},
        
	render: function() {
		this.$el.html(this.template(this.model.attributes));
		return this;
	},
        
	edit: function() {
		new TaskDialog({model: this.model}).show();
	},

	modify: function(e) {
		var status = e.currentTarget.checked ? 1 : 0;
		this.model.set({status: status});
		this.model.save();

		if (status === 1) {
			this.$el.find('td').addClass('finished');
		} else {
			this.$el.find('td').removeClass('finished');
		}
	},

	delete: function (e) {
		this.model.destroy();

		this.$el.remove();
		e.preventDefault();
	}
});