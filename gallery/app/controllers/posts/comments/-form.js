export default Ember.ObjectController.extend({
	actions: {
		save: function() {
			var self = this;
			this.get('model').save().then(function() {
				self.transitionTo('posts.index');
			});
		}
	}
});
