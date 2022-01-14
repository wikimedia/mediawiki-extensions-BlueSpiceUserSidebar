<?php

namespace BlueSpice\UserSidebar\Component;

use Message;
use MWStake\MediaWiki\Component\CommonUserInterface\Component\RestrictedTextLink;
use Title;

class EditPersonalMenu extends RestrictedTextLink {

	/**
	 * @var Title
	 */
	protected $userSidebarTitle = '';

	/**
	 * @param Title $userSidebarTitle
	 */
	public function __construct( $userSidebarTitle ) {
		$this->userSidebarTitle = $userSidebarTitle;
		parent::__construct( [] );
	}

	/**
	 *
	 * @return string
	 */
	public function getId(): string {
		return 'mm-usersidebar-edit';
	}

	/**
	 *
	 * @inheritDoc
	 */
	public function getRequiredRLStyles(): array {
		return [ "ext.blueSpice.userSidebar.menu.styles" ];
	}

	/**
	 *
	 * @return string[]
	 */
	public function getPermissions(): array {
		return [ 'edit' ];
	}

	/**
	 * @return string
	 */
	public function getHref(): string {
		return $this->userSidebarTitle->getEditURL();
	}

	/**
	 * @return Message
	 */
	public function getText(): Message {
		return Message::newFromKey( 'bs-edit-user-mm-link-text' );
	}

	/**
	 * @return Message
	 */
	public function getTitle(): Message {
		return Message::newFromKey( 'bs-edit-user-mm-link-title' );
	}

	/**
	 * @return Message
	 */
	public function getAriaLabel(): Message {
		return Message::newFromKey( 'bs-edit-user-mm-link-text' );
	}

}
