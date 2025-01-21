// eslint-disable-next-line no-global-assign
ext = ext || {};
ext.usersidebar = ext.usersidebar || {};
ext.usersidebar.data = {};

ext.usersidebar.data.UsersidebarKeywordNode = function ( cfg ) {
	ext.usersidebar.data.UsersidebarKeywordNode.parent.call( this, cfg );

	var config = require( './config.json' );
	var keywords = config.allowedUserSidebarKeywords;

	this.options = [];
	for ( var i = 0; i < keywords.length; i++ ) {
		var object = {
			data: keywords[ i ]
		};
		this.options.push( object );
	}
};

OO.inheritClass( ext.usersidebar.data.UsersidebarKeywordNode,
	ext.menueditor.ui.data.node.KeywordNode );

ext.usersidebar.data.UsersidebarKeywordNode.prototype.getFormFields = function ( dialog ) {
	return [
		{
			name: 'keyword',
			type: 'dropdown',
			options: this.options,
			// eslint-disable-next-line camelcase
			widget_$overlay: dialog.$overlay,
			required: true,
			label: mw.message( 'menueditor-ui-form-field-keyword' ).text(),
			help: mw.message( 'menueditor-ui-menu-keyword-help' ).text()
		}
	];
};
