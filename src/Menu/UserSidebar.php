<?php

namespace BlueSpice\UserSidebar\Menu;

use BlueSpice\UserSidebar\WidgetFactory;
use MediaWiki\Extension\MenuEditor\IMenu;
use MWStake\MediaWiki\Component\Wikitext\Node\Menu\Keyword;
use Title;

class UserSidebar implements IMenu {
	/** @var WidgetFactory */
	private $widgetFactory;

	/**
	 * @param WidgetFactory $widgetFactory
	 */
	public function __construct( WidgetFactory $widgetFactory ) {
		$this->widgetFactory = $widgetFactory;
	}

	/**
	 * @inheritDoc
	 */
	public function getJSClassname(): string {
		return 'ext.usersidebar.menu.UserSidebarTree';
	}

	/**
	 * @inheritDoc
	 */
	public function getRLModule(): string {
		return 'ext.blueSpice.userSidebar.menu';
	}

	/**
	 * @inheritDoc
	 */
	public function appliesToTitle( Title $title ): bool {
		if ( !$title->getNamespace() === NS_USER ) {
			return false;
		}
		$page = $title->getDBkey();
		return substr( $page, -8 ) === '/Sidebar';
	}

	/**
	 * @inheritDoc
	 */
	public function getKey(): string {
		return 'user-sidebar';
	}

	/**
	 * @inheritDoc
	 */
	public function getEmptyContent(): array {
		$nodes = [];
		foreach ( $this->widgetFactory->getAllKeys() as $key ) {
			$nodes[] = new Keyword( 1, $key );
		}
		return $nodes;
	}
}
