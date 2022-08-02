<?php

namespace BlueSpice\UserSidebar;

use Config;
use ResourceLoaderContext;

class ClientConfig {

	/**
	 *
	 * @param ResourceLoaderContext $context
	 * @param Config $config
	 * @return array
	 */
	public static function makeConfigJson(
		ResourceLoaderContext $context,
		Config $config
	) {
		$allowedUserSidebarKeywords = $config->get( 'MenuEditorUserSidebarAllowedKeywords' );
		return [
			'allowedUserSidebarKeywords' => $allowedUserSidebarKeywords
		];
	}
}
