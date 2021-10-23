<?php

namespace BlueSpice\UserSidebar\Component\SimpleCard;

use IContextSource;
use MediaWiki\Linker;
use MWStake\MediaWiki\Component\CommonUserInterface\Component\Literal;
use MWStake\MediaWiki\Component\CommonUserInterface\Component\SimpleCard;
use MWStake\MediaWiki\Component\CommonUserInterface\Component\SimpleCardHeader;
use MWStake\MediaWiki\Component\CommonUserInterface\Component\SimpleLinklistGroupFromArray;
use Sanitizer;

class PersonalMenu extends SimpleCard {

	/**
	 * @var string
	 */
	protected $section = null;

	/**
	 * @var array
	 */
	protected $links = null;

	/**
	 * @var IContextSource
	 */
	protected $context = null;

	/**
	 * @param string $section
	 * @param array $links
	 */
	public function __construct( string $section, array $links ) {
		$this->section = $section;
		$this->links = $links;
		parent::__construct( [] );
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		$id = Sanitizer::escapeIdForAttribute( $this->section );
		return "umcus-$id";
	}

	/**
	 * @inheritDoc
	 */
	public function getContainerClasses(): array {
		return [ 'card-mn' ];
	}

	/**
	 *
	 * @param IContextSource $context
	 * @return bool
	 */
	public function shouldRender( IContextSource $context ): bool {
		$this->context = $context;
		return !empty( $this->links );
	}

	/**
	 * @inheritDoc
	 */
	public function getSubComponents(): array {
		$id = Sanitizer::escapeIdForAttribute( $this->section );
		return [
			new SimpleCardHeader( [
				'id' => "umcus-menu-head-$id",
				'classes' => [ 'menu-title' ],
				'items' => [
					new Literal(
						"umcus-menu-title-$id",
						$this->section
					)
				]
			] ),
			new SimpleLinklistGroupFromArray( [
				'id' => "umcus-manu-$id-linkgroup",
				'classes' => [ 'menu-card-body', 'menu-list', 'll-dft' ],
				'links' => $this->formatLinks( $this->links )
			] ),
		];
	}

	/**
	 * @param array $links
	 * @return array
	 */
	private function formatLinks( $links ): array {
		$params = [];

		foreach ( $links as $key => $link ) {
			if ( is_string( $key ) ) {
				$strpos = strpos( $key, '-' );
				$subKey = substr( $key, $strpos + 1 );
			}

			if ( isset( $link['text'] ) && $link['text'] !== '' ) {
				$msg = $this->context->msg( $link['text'] );
				if ( $msg->exists() ) {
					$link['text'] = $msg->text();
				}
			} elseif ( isset( $link['msg'] ) && $link['msg'] === '' ) {
				$msg = $this->context->msg( $link['msg'] );
				if ( $msg->exists() ) {
					$link['text'] = $msg->text();
				}
			} elseif ( is_string( $key ) && $this->context->msg( $key )->exists() ) {
				$msg = $this->context->msg( $key );
				$link['text'] = $msg->text();
			} elseif ( is_string( $key ) && $this->context->msg( $subKey )->exists() ) {
				$msg = $this->context->msg( $subKey );
				$link['text'] = $msg->text();
			} else {
				continue;
			}

			if ( isset( $link['title'] ) && $link['title'] !== '' ) {
				$msg = $this->context->msg( $link['title'] );
				if ( $msg->exists() ) {
					$link['title'] = $msg->text();
				}
			} elseif ( is_string( $key ) && $this->context->msg( $key )->exists() ) {
				$msg = $this->context->msg( $key );
				if ( $msg->exists() ) {
					$link['title'] = $msg->text();
				}
			} elseif ( isset( $link['id'] ) && $link['id'] !== '' ) {
				$tooltip = Linker::titleAttrib( $link['id'] );
				if ( $tooltip ) {
					$link['title'] = $tooltip;
				}
			}

			if ( isset( $link['data-mw'] ) && isset( $link['data'] ) ) {
				$link['data']['mw'] = $link['data-mw'];
			} elseif ( isset( $link['data-mw'] ) ) {
				$link['data'] = [
					'mw' => $link['data-mw']
				];
			}

			$params[] = $link;
		}

		return $params;
	}
}
