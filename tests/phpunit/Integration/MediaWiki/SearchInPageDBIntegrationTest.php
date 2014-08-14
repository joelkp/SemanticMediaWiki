<?php

namespace SMW\Tests\Integration\MediaWiki;

use SMW\Tests\Util\PageCreator;
use SMW\Tests\Util\PageDeleter;
use SMW\Tests\MwDBaseUnitTestCase;

use SMW\MediaWiki\Search\Search;

use Title;

/**
 * @group SMW
 * @group SMWExtension
 * @group semantic-mediawiki-integration
 * @group mediawiki-database
 * @group medium
 *
 * @license GNU GPL v2+
 * @since 2.1
 *
 * @author mwjames
 */
class SearchInPageDBIntegrationTest extends MwDBaseUnitTestCase {

	protected $databaseToBeExcluded = array( 'sqlite' );

	public function testSearchForPageValueAsTerm() {

		$propertyPage = Title::newFromText( 'Has some page value', SMW_NS_PROPERTY );
		$targetPage = Title::newFromText( __METHOD__ );

		$pageCreator = new PageCreator();

		$pageCreator
			->createPage( $propertyPage )
			->doEdit( '[[Has type::Page]]' );

		$pageCreator
			->createPage( $targetPage )
			->doEdit( '[[Has some page value::Foo]]' );

		$search = new Search();
		$results = $search->searchTitle( '[[Has some page value::Foo]]' );

		$this->assertInstanceOf(
			'\SMW\MediaWiki\Search\SearchResultSet',
			$results
		);

		$this->assertEquals( 1, $results->getTotalHits() );

		$pageDeleter = new PageDeleter();
		$pageDeleter->deletePage( $targetPage );
		$pageDeleter->deletePage( $propertyPage );
	}

	public function testSearchForGeographicCoordinateValueAsTerm() {

		if ( !defined( 'SM_VERSION' ) ) {
			$this->markTestSkipped( 'This test needs Semantic Maps to be available' );
		}

		$propertyPage = Title::newFromText( 'Has coordinates', SMW_NS_PROPERTY );
		$targetPage = Title::newFromText( __METHOD__ );

		$pageCreator = new PageCreator();

		$pageCreator
			->createPage( $propertyPage )
			->doEdit( '[[Has type::Geographic coordinate]]' );

		$pageCreator
			->createPage( $targetPage )
			->doEdit( "[[Has coordinates::52°31'N, 13°24'E]]" );

		$search = new Search();
		$results = $search->searchTitle( "[[Has coordinates::52°31'N, 13°24'E]]" );

		$this->assertInstanceOf(
			'\SMW\MediaWiki\Search\SearchResultSet',
			$results
		);

		$this->assertEquals( 1, $results->getTotalHits() );

		$pageDeleter = new PageDeleter();
		$pageDeleter->deletePage( $targetPage );
		$pageDeleter->deletePage( $propertyPage );
	}

}