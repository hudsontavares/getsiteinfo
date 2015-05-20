<?php namespace App\AttachableParsers;

/**
 * This attachable parser can read information from headers.
 *
 */
class MetatagsAttachableParser implements \App\Interfaces\AttachableParser
{
    /**
     *  Returns the internal name of the instance.
     *
     *  @returns string 'Headers'
     */
    public function getName(){return 'Metatags';}
    
    /**
     *  Parses all the <meta> tag entries from the data model,
     *  if applicable.
     *
     *  @return array the hash containing the key => value entries found.
     */
    public function parse(\App\Interfaces\DataParser $data)
    {
        $returnData = array();
        if(!is_null($data) && $data->isParsed())
        {
            $metatags = array();$propertyName = array('http-equiv', 'property', 'name');
            if(!is_null($data->getDataModel()))$metatags = $data->getDataModel()->documentElement->getElementsByTagName('meta');
            foreach($metatags as $metatag)
            {
              $key = null;
              foreach($propertyName as $keyName)
                if($metatag->hasAttribute($keyName))$key = $keyName;
              if(is_null($key))continue;
              $returnData[mb_convert_case($metatag->getAttribute($key), MB_CASE_LOWER, 'UTF-8')] = $metatag->getAttribute('content');
            }
        }
        return $returnData;
    }
}
