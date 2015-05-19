<?php namespace App;

use \App\Interfaces\AttachableParser;
use \App\Interfaces\DataParser;

    /**
     *  This class implements, through IoC and Interface Segregation principles,
     *  a highly configurable parser that allows the extraction of a wide range
     *  of information from content.
     *
     **/
    class UriParser
    {
        /**
         *  Retains a list of attachable parsers, that are executed each time
         *  the parsing process is called.
         */
        private $attachableParsers = [];
        
        /**
         *  The base constructor of the class.
         *
         *  @returns void
         **/
        public function __construct(){}
        
        /**
         *  Adds an attachable parser to the list of this instance of the class.
         *
         *  @returns UriParser the instance reference itself.
         **/
        public function addAttachableParser(AttachableParser $parser)
        {
            if(!is_null($parser) && !in_array($parser, $this->attachableParsers, true))
                $this->attachableParsers[] = $parser;
            return $this;
        }
        
        /**
         *  Removes an attachable parser from the list of this instance of the class.
         *
         *  @returns UriParser the instance reference itself.
         **/
        public function removeAttachableParser(AttachableParser $parser)
        {
            if(!is_null($parser) && ($pos = array_search($parser, $this->attachableParsers, true)) !== false)
                array_splice($this->attachableParsers, $pos, 1);
            return $this;
        }
        
        
        /**
         *  Parses the data from a DataParser entry, using the attached parsers
         *  bind to the instance.
         *
         *  @returns array() a hash of keys and values, split for each AttachableParser
         **/
        public function parse(DataParser $parser)
        {
            $returnData = array();
            if(!is_null($returnData))
            {
                foreach($this->attachableParsers as $attachableParser)
                {
                    if(!isset($returnData[$attachableParser->getName()]))
                        $returnData[$attachableParser->getName()] = array();
                    $returnData[$attachableParser->getName()] = array_merge($returnData[$attachableParser->getName()], $attachableParser->parse($parser));
                }
            }
            return $returnData;
        }
    }
