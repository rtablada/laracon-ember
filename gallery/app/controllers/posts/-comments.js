export default Ember.ArrayController.extend({
	needs: ['posts/show'],
	newComment: function() {
		return this.store.createRecord('comment', {
			post: this.get('controllers.posts/show.model')
		});
	}.property(),
	sortProperties: ['id'],
	sortAscending: false
});
