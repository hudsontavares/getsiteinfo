<?php namespace App\DataParsers;

use \App\Interfaces\DataParser;
use \App\Traits\HttpHeadersParser;

/**
 *  Basic implementation of an HTTP request using the GET method.
 */
class HttpGetDataParser implements DataParser
{
    /* To enable the class to parse HTTP headers */
    use HttpHeadersParser{HttpHeadersParser::parse as httpHeadersParser;}
    
    private $target     = '';
    private $dataModel  = null;
    private $metadata   = array();
    private $parsed     = false;
    
    public function __construct($target){$this->target = $target;}
    public function getTarget(){return $this->target;}
    public function getDataModel(){return $this->dataModel;}
    public function getMetadata(){return $this->metadata;}
    public function isParsed(){return $this->parsed;}
    public function parse()
    {
        if($this->parsed)return $this;
        if(is_null($this->target) || $this->target == '')return $this;
        
        $context = stream_context_create(['http' => ['timeout' => 10]]);
        $data    = @file_get_contents($this->target, 0, $context);
        
        if($data === false)return $this;
        
        $this->parsed    = true;
        $this->metadata  = $this->httpHeadersParser($http_response_header);
        $this->dataModel = new \DOMDocument('1.0', 'UTF-8');
        @$this->dataModel->loadHTML($data);
        return $this;
    }
}
