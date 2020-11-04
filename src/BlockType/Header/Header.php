<?php

namespace AcfEngine\Core\BlockType;

if (!defined('ABSPATH')) {
	exit;
}

class Header extends BlockType {

  public function key() {
		return 'header';
	}

  public function title() {
    return 'ACFG Header';
  }

  public function description() {
    return 'Renders a site header.';
  }

  public function renderCallback() {
    return [$this, 'callback'];
  }

  public function callback( $block, $content, $isPreview, $postId ) {
		$this->render( $block, $content, $postId );
  }

	protected function render( $block, $content, $postId ) {

		$key = get_field('key');
		$tm = new \AcfEngine\Core\TemplateManager();
		$template = $tm->fetchByKey( $key );

		if( !$template ) {
			print 'SORRY THAT TEMPLATE COULD NOT BE FOUND.';
		}

		$content = $this->parseBlockContent( $template->post_content );
		print $content;

	}

}
