export default DS.Model.extend({
	body: DS.attr(),

	compiledBody: function() {
		if (this.get('body')) {
			return markdown.toHTML(this.get('body'));
		}
	}.property('body'),

	post: DS.belongsTo('post', {async: true})
});
