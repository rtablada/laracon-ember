export default Ember.ObjectController.extend({
	actions: {
		save: function() {
			this.get('model').save().then(function() {
				this.transitionTo('posts.index');
			});
		}
	}
});
