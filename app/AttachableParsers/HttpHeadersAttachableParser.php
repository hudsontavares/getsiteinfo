<?php namespace App\AttachableParsers;

use \App\Traits\HttpHeadersParser;

/**
 * This attachable parser can read information from headers of an HTTP request.
 *
 */
class HttpHeadersAttachableParser implements \App\Interfaces\AttachableParser
{
    /* To enable the class to parse HTTP headers */
    use HttpHeadersParser{HttpHeadersParser::parse as httpHeadersParser;}
    
    /**
     *  Returns the internal name of the instance.
     *
     *  @returns string 'Headers'
     */
    public function getName(){return 'HTTP_Headers';}
    
    /**
     *  Parses all the DataParser.getMetadata() entries and generates a hash from the headers.
     *
     *  @return array the hash containing the parsed data.
     */
    public function parse(\App\Interfaces\DataParser $data)
    {
        $returnData = array();
        if(!is_null($data))$returnData = $this->httpHeadersParser($data->getMetadata());
        return $returnData;
    }
}
