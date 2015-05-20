<?php
use \App\Interfaces\AttachableParser;
use \App\AttachableParsers\HttpHeadersAttachableParser;
use \App\AttachableParsers\MetatagsAttachableParser;
use \App\DataParsers\HttpGetDataParser;
use \App\UriParser;

class TestAttachableParsers extends PHPUnit_Framework_TestCase
{
    private $dataParser;
    private $uriParser;
    
    public function setUp()
    {
      $this->dataParser = new HttpGetDataParser($target = 'http://www.terra.com.br');
      $this->uriParser  = new UriParser();
      $this->dataParser->parse();
    }

	/**
	 * Testing the HTTP headers attachable parser.
	 *
	 * @return void
	 */
	public function testHttpHeadersAttachableParser()
	{
      $parser = new HttpHeadersAttachableParser();
      $this->uriParser->addAttachableParser($parser);
      $data = $this->uriParser->parse($this->dataParser);
      
      /* Asserting rules */
      $this->assertArrayHasKey($parser->getName(), $data, 'The attachable parser for HTTP headers isn\'t working as expected.');
      $data = $data[$parser->getName()];
      $this->assertArrayHasKey('status_code', $data, 'The attachable parser for HTTP headers was unable to get the response code of the request.');
      $this->assertEquals(200, $data['status_code'], 'The request for "' . $this->dataParser->getTarget() . '" returned the an status response different from 200 (OK).');
      $this->uriParser->removeAttachableParser($parser);
	}

	/**
	 * Testing the Metatags attachable parser.
	 *
	 * @return void
	 */
	public function testMetatagsAttachableParser()
	{
      $parser = new MetatagsAttachableParser();
      $this->uriParser->addAttachableParser($parser);
      $data = $this->uriParser->parse($this->dataParser);
      
      /* Asserting rules */
      $this->assertArrayHasKey($parser->getName(), $data, 'The attachable parser for HTML metatags isn\'t working as expected.');
      $data = $data[$parser->getName()];
      $this->assertGreaterThan(0, sizeof($data), 'The attachable parser for HTML metatags was unable to read any meta tags from the data source.');
      $this->uriParser->removeAttachableParser($parser);
	}
}
