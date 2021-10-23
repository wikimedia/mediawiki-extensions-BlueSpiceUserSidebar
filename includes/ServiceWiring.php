<?php

use BlueSpice\UserSidebar\Parser;
use BlueSpice\UserSidebar\WidgetFactory;
use MediaWiki\MediaWikiServices;

return [

	'BSUserSidebarWidgetFactory' => static function ( MediaWikiServices $services ) {
		$registry = $services->getService( 'MWStakeManifestRegistryFactory' )
			->get( 'BlueSpiceUserSidebarWidgetRegistry' );
		return new WidgetFactory(
			$registry,
			$services->getMainConfig()
		);
	},

	'BSUserSidebarParser' => static function ( MediaWikiServices $services ) {
		return new Parser(
			$services->getService( 'BSUserSidebarWidgetFactory' ),
			$services->getTitleFactory()
		);
	},

];
