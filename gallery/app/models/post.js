export default DS.Model.extend({
	body: DS.attr(),

	compiledBody: function() {
		if (this.get('body')) {
			return markdown.toHTML(this.get('body'));
		}
	}.property('body'),

	short: function() {
		if (this.get('body')) {
			var text = this.get('body').split(/[^\S\n]+/).slice(0,10).join(" ");
			return markdown.toHTML(text);
		}
	}.property('body'),

	comments: DS.hasMany('comment')
});
