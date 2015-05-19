<?php namespace \App\Interfaces;
/**
 *  This interface defines the basic exposed functionality for
 *  any parsing-capable class that wants to interact with this
 *  library.
 *
 *  @author Hudson Tavares <hudson.tavares@gmail.com>
 **/
    interface AttachableParser
    {
        /**
         *  Returns the internal name of the AttachableParser, usually the fully
         *  qualified name of the class that implements this interface.
         *
         *  @returns string the name of this AttachableParser
         **/
        public function getName();
        /**
         *  Evaluates information from an specified \App\Interfaces\DataParser entry
         *  and retrieves the information found. If there's no information to return,
         *  it must return an empty array.
         *
         *  @param DataParser $data the object to be inspected
         *  @returns array() a hash of keys and values obtained from $data
         **/
        public function parse(DataParser $data);
    }
