<?php

/**
 * This special page for Semantic MediaWiki implements a customisable form for
 * executing queries outside of articles. Results are generated by 
 * SMW_SpecialAsk.php. This page is currently under development as part of 
 * the Google Summer of Code 2011 Program. 
 *
 * @file SMW_SpecialQueryCreator.php
 * @ingroup SMWSpecialPage
 * @ingroup SpecialPage
 *
 * @author Markus Krötzsch
 * @author Yaron Koren
 * @author Sanyam Goyal
 * @author Jeroen De Dauw
 * @author Devayon Das
 *
 */
class SMWQueryCreatorPage extends SpecialPage {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct( 'QueryCreator' );
		smwfLoadExtensionMessages( 'SemanticMediaWiki' );
	}

	/**
	 * Main entrypoint for the special page.
	 *
	 * @param string $p
	 */
	public function execute( $p ) {
		global $wgOut, $wgRequest, $smwgQEnabled;
                $this->setHeaders();
                $wgOut->addWikiText( "Hi. This page isn't ready for viewing yet. May I suggest you view [[Special:Ask]]");
	}

}

