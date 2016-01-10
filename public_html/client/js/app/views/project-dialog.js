/*
 * Project dialog view, form for creating and editing projects
 */
ProjectDialog = Backbone.View.extend({
	events: {
		'click .save-action': 'save',
		'click .close,.close-action': 'close',
		'change input': 'modify'
	},
        
	initialize: function() {
		this.template = _.template($('#project-dialog').html());
	},
        
	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},

	show: function() {
		$(document.body).append(this.render().el);
	},

	close: function() {
		this.remove();
	},

	save: function() {

		if (null == this.model.get('project_id')) {
			TodoApp.projects.create(this.model);
		} else {
                        this.model.id = this.model.get('project_id');
			this.model.save();
		}

		this.remove();
	},

	modify: function(e) {
		var attribute = {};
		attribute[e.currentTarget.name] = e.currentTarget.value;
		this.model.set(attribute);
	}
});