var Router = Ember.Router.extend({
  location: ENV.locationType
});

Router.map(function() {
	this.resource('posts', function() {
		this.route('create', { path: 'new' });
		this.route('show', { path: ':post_id' });
		this.route('edit', { path: ':post_id/edit' });
	});
});

export default Router;
