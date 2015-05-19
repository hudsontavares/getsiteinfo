<?php namespace App\Interfaces;
/**
 *  This interface defines the basic exposed functionality for
 *  data parsers, software artifacts that receives an URI and
 *  are capable of retrieving and parsing data belonging to it.
 *
 *  @author Hudson Tavares <hudson.tavares@gmail.com>
 **/
    interface DataParser
    {
        /**
         *  Returns the current target content of this parser.
         *
         *  @returns string the URI the object points to.
         */
        public function getTarget();
        
        /**
         *  Returns the data model object that encapsulates
         *  the data retrieved by this object.
         *
         *  @return DOMDocument a object that exposes the data model or NULL if no object is exposable yet.
         */
        public function getDataModel();
        
        /**
         *  Returns an array containing all the metadata related
         *  to the data model. Useful for exposing headers and other
         *  info received from a remote source, when applicable.
         *
         *  @return array() a hash containing key-value pairs of each metadata entry
         */
        public function getMetaData();
        
        /**
         *  Reads and transforms the data pointed by the object.
         *
         *  @returns DataParser a reference for the own object.
         */
        public function parse();
        
        /**
         *  A getter method that allows the implementing class to inform
         *  to an outside called if it's parsing logic has already been
         *  executed on the object instance.
         *
         *  @returns boolean true if the data has already been parsed, false otherwise.
         */
        public function isParsed();
    }
