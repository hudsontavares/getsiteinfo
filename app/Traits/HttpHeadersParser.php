<?php namespace App\Traits;
/**
 *  This trait implements the functionality that allows an implementing class
 *  to parse HTTP headers.
 *  
 **/
trait HttpHeadersParser
{
    /**
     *  Given an input array with headers, this method parses and returns
     *  a hash from all headers with the format Name: Value
     *
     *  @param $input String[] a list of headers to be parsed
     *  @returns String[] a hash map from the values found
     */
    private function parse($input)
    {
        $returnData = array();
        
        if(is_array($input))
        {
            if(sizeof($input) > 0)
            {
                $statusCode                 = explode(' ', $input[0]);
                $statusCode                 = isset($statusCode[1]) ? ( int ) $statusCode[1] : 200;
                $returnData['status_code']  = $statusCode;
            }
            
            foreach($input as $header)
            {
                $pos = mb_strpos($header, ':');
                if($pos === false)continue;
                $key    = trim(mb_substr($header, 0, $pos));
                $value  = trim(mb_substr($header, $pos));
                if($key != '')$returnData[$key] = $value;
            }
        }
        
        return $returnData;
    }
}
