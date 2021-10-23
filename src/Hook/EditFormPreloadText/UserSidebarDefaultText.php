<?php

namespace BlueSpice\UserSidebar\Hook\EditFormPreloadText;

use BlueSpice\Hook\EditFormPreloadText;

class UserSidebarDefaultText extends EditFormPreloadText {

	/**
	 *
	 * @return bool
	 */
	protected function skipProcessing() {
		$user = $this->getContext()->getUser();
		$userPage = \Title::makeTitle( NS_USER, $user->getName() . "/Sidebar" );
		if ( $this->title->equals( $userPage ) ) {
			return false;
		}
		return true;
	}

	/**
	 *
	 * @return bool
	 */
	protected function doProcess() {
		$this->text = implode( "\n", $this->getWidgetLinks() );
		return true;
	}

	/**
	 *
	 * @return array
	 */
	protected function getWidgetLinks() {
		if ( $this->getContext()->getSkin()->getSkinName() === 'bluespicecalumma' ) {
			return $this->getLegacyWidgetLinks();
		}
		$factory = $this->getServices()->getService( 'BSUserSidebarWidgetFactory' );
		$widgets = [];
		foreach ( $factory->getAllKeys() as $key ) {
			$widgets[] = "* $key";
		}
		return $widgets;
	}

	/**
	 * DEPRECATED
	 * @deprecated since version 4.1 - - Support ends with BlueSpiceCalumma
	 * @return array
	 */
	private function getLegacyWidgetLinks() {
		wfDebugLog( 'bluespice-deprecations', __METHOD__, 'private' );
		$widgetRegistry = \ExtensionRegistry::getInstance()->getAttribute(
			'BlueSpiceUserSidebarWidgets'
		);
		$widgets = [];
		foreach ( $widgetRegistry as $key => $config ) {
			if ( !$config['default'] ) {
				continue;
			}
			$widgets[] = "* $key";
		}
		return $widgets;
	}

}
