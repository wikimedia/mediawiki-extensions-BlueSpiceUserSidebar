<?php

namespace BlueSpice\UserSidebar\Panel;

use BlueSpice\Calumma\IPanel;
use BlueSpice\Calumma\Panel\BasePanel;
use QuickTemplate;
use Skins\Chameleon\IdRegistry;

/**
 * DEPRECATED!
 * @deprecated since version 4.1 - Support ends with BlueSpiceCalumma
 */
class CollapsibleLinks extends BasePanel implements IPanel {
	/**
	 *
	 * @var string
	 */
	protected $section;
	/**
	 *
	 * @var array
	 */
	protected $links = [];
	/**
	 *
	 * @var string
	 */
	protected $sectionId;

	/**
	 *
	 * @param QuickTemplate $skintemplate
	 * @param string $section
	 * @param array $links
	 * @param string $sectionId
	 */
	public function __construct( QuickTemplate $skintemplate, $section, $links, $sectionId ) {
		parent::__construct( $skintemplate );
		$this->section = $section;
		$this->links = $links;
		$this->sectionId = $sectionId;
	}

	/**
	 * @return string
	 */
	public function getTitleMessage() {
		return $this->section;
	}

	/**
	 * @return string
	 */
	public function getBody() {
		$linkListGroup = new \BlueSpice\Calumma\Components\SimpleLinkListGroup( $this->links );

		return $linkListGroup->getHtml();
	}

	/**
	 *
	 * @var string
	 */
	protected $htmlId = null;

	/**
	 * The HTML ID for thie component
	 * @return string
	 */
	public function getHtmlId() {
		if ( $this->htmlId === null ) {
			$this->htmlId = IdRegistry::getRegistry()->getId( $this->sectionId );
		}
		return $this->htmlId;
	}

	/**
	 *
	 * @return bool
	 */
	public function getPanelCollapseState() {
		$htmlId = $this->htmlId;

		$cookieName = $this->getCookiePrefix() . $htmlId;
		$skin = $this->skintemplate->getSkin();
		$cookie = $skin->getRequest()->getCookie( $cookieName );

		if ( $cookie === 'true' ) {
			return true;
		} else {
			return false;
		}
	}
}
