export default Ember.ObjectController.extend({
	actions: {
		save: function() {
			var self = this;
			this.get('model').save().then(function() {
				this.content = this.store.createRecord('comment', {
					post: this.get('post')
				});
			});
		}
	}
});
