// eslint-disable-next-line no-global-assign
ext = ext || {};
ext.usersidebar = ext.usersidebar || {};
ext.usersidebar.data = {};

ext.usersidebar.data.UsersidebarKeywordNode = function ( cfg ) {
	ext.usersidebar.data.UsersidebarKeywordNode.parent.call( this, cfg );
};

OO.inheritClass( ext.usersidebar.data.UsersidebarKeywordNode,
	ext.menueditor.ui.data.node.KeywordNode );

ext.usersidebar.data.UsersidebarKeywordNode.prototype.getFormFields = function () {
	return [
		{
			name: 'keyword',
			type: 'dropdown',
			options: [
				{ data: 'PAGESVISITED' },
				{ data: 'YOUREDITS' }
			],
			// eslint-disable-next-line camelcase
			widget_$overlay: true,
			required: true,
			label: mw.message( 'menueditor-ui-form-field-keyword' ).text(),
			help: mw.message( 'menueditor-ui-menu-keyword-help' ).text()
		}
	];
};
