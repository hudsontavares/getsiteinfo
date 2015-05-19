<?php

use \App\DataParsers\HttpGetDataParser;

class TestDataParsers extends PHPUnit_Framework_TestCase {

	/**
	 * Testing the data receiving mechanism for GET requests.
	 *
	 * @return void
	 */
	public function testHttpGetDataParser()
	{
            $httpGetDataParser = new HttpGetDataParser($target = 'http://www.uol.com.br');
            $this->assertEquals($httpGetDataParser->getTarget(), $target, 'The target attribute has changed. It should not happen.');
            $this->assertTrue(!$httpGetDataParser->isParsed(), 'The component have it\'s initial state wrongly changed.');
            
            $httpGetDataParser->parse();
	    $this->assertTrue($httpGetDataParser->isParsed(), 'The component was unable to parse the specified URL.');
	    $this->assertGreaterThan(0, sizeof($httpGetDataParser->getMetadata()), 'The component was unable to get any headers.');
	    $this->assertNotNull($httpGetDataParser->getDataModel()->documentElement, 'The returned data wasn\'t able to be parsed as HTML.');
	}

}
