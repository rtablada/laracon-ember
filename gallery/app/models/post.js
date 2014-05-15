export default DS.Model.extend({
	body: DS.attr(),

	compiledBody: function() {
		if (this.get('body')) {
			return markdown.toHTML(this.get('body'));
		}
	}.property('body'),

	short: function() {
		if (this.get('body')) {
			var text = this.get('body').split(/\s+/).slice(0,5).join(" ");
			return markdown.toHTML(text);
		}
	}.property('body')
});
