<?php namespace App\DataParsers;

use \App\Interfaces\DataParser;

/**
 *  Basic implementation of an HTTP request using the GET method.
 */
class HttpGetDataParser implements DataParser
{
    private $target     = '';
    private $timeout    = 10;
    private $dataModel  = null;
    private $metadata   = array();
    private $parsed     = false;
    
    /**
     *  Constructor of the class. Sets the target URI and max timeout for connection.
     *
     *  @returns void
     **/
    public function __construct($target, $timeout = 10)
    {
        $this->target = $target;
        $this->timeout= $timeout;
    }
    
    /**
     *  Gets the target URI of the instance.
     *
     *  @returns string the URI, as specified on the constructor
     **/
    public function getTarget(){return $this->target;}
    
    /**
     *  Gets the data model of the parsed URI.
     *
     *  @returns Object the data model or NULL if it hasn't been parsed.
     */
    public function getDataModel(){return $this->dataModel;}
    
    /**
     *  Gets the metadata (headers) of the parsed URI response.
     *
     *  @returns String[] an array containing all returned headers.
     */
    public function getMetadata(){return $this->metadata;}
    
    /**
     *  Checks and returns if the URI has already been successfully parsed.
     *
     *  @returns boolean true if it has been parsed.
     */
    public function isParsed(){return $this->parsed;}
    
    /**
     *  Reads only once the data related to the target URI of this instance.
     *
     *  @returns HttpGetDataParser the reference for the object itself.
     */
    public function parse()
    {
        if($this->parsed)return $this;
        if(is_null($this->target) || $this->target == '')return $this;
        
        $context = stream_context_create(['http' => ['timeout' => $this->timeout]]);
        $data    = @file_get_contents($this->target, 0, $context);
        
        if($data === false)return $this;
        
        $this->parsed    = true;
        $this->metadata  = $http_response_header;
        $this->dataModel = new \DOMDocument('1.0', 'UTF-8');
        @$this->dataModel->loadHTML('<?xml version="1.0" encoding="UTF-8" ?>' . $data);
        return $this;
    }
}
