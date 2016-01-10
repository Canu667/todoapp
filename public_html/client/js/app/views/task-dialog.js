/*
 * Modal dialog/form for creating or editing single task
 */
TaskDialog = Backbone.View.extend({
	events: {
		'click .save-action': 'save',
		'click .close,.close-action': 'close'
	},
        
	initialize: function() {
		this.template = _.template($('#task-dialog').html());
	},
        
	render: function() {
		this.$el.html(this.template(this.model.toJSON()));

		this.$el.find('#dp1').datetimepicker();
		return this;
	},
        
	show: function() {
		$(document.body).append(this.render().el);
	},
        
	close: function() {
		this.remove();
	},

	save: function() {
		var that = this;
		$.each(this.$el.find('input'), function(i, item) {
			var attribute = {};

			attribute[item.name] = item.value;
			that.model.set(attribute);
		});

		if (null == this.model.get('project_id_ref')) {
			this.model.set({project_id_ref: TodoApp.currentProjectId});
			TodoApp.tasks.create(this.model);
		} else {
			this.model.save();
		}
		this.remove();
	}
});