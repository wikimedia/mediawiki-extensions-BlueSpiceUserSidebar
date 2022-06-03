<?php

namespace BlueSpice\UserSidebar\Hook\BSUsageTrackerRegisterCollectors;

use BS\UsageTracker\Hook\BSUsageTrackerRegisterCollectors;

class NoOfUserSidebars extends BSUsageTrackerRegisterCollectors {

	protected function doProcess() {
		$this->collectorConfig['bs:usersidebars'] = [
			'class' => 'Database',
			'config' => [
				'identifier' => 'no-of-user-sidebars',
				'descKey' => 'no-of-user-sidebars',
				'table' => 'page',
				'uniqueColumns' => [ 'page_title' ],
				'condition' => [ 'page_namespace' => NS_USER,
				'page_title like "%/Sidebar"'
				]
			]
		];
	}

}
