export default DS.Model.extend({
	body: DS.attr(),

	compiledBody: function() {
		if (this.get('body')) {
			return markdown.toHTML(this.get('body'));
		}
	}.property('body'),

	post: DS.belongsTo('post'),

	didCreate: function() {
		var self = this;
		Em.RSVP.resolve(this.get('post')).then(function(post){
			post.get('comments').pushObject(self);
		});
	}
});
