<?php
    namespace \App\Interfaces;
/**
 *  This interface defines the basic exposed functionality for
 *  data parsers, software artifacts that receives an URI and
 *  are capable of retrieving and parsing data belonging to it.
 *
 *  @author Hudson Tavares <hudson.tavares@gmail.com>
 **/
    interface DataParser
    {
        public function __construct($target);
        public function getTarget();
        public function getDataModel();
        public function getMetaData();
        public function parse();
    }
