<?php

namespace Opendisk\GoogleSuggest;

class GoogleSuggest
{
	public static function grab($keyword = '', $lang = '', $country = '', $source = '', $proxy = '')
	{
        $url = 'https://suggestqueries.google.com/complete/search?';

        $query = [
            'client' => 'chrome',
            'q' => $keyword,
        ];

        if(!empty($lang)){
            $query['hl'] = $lang;
        }

        if(!empty($country)){
            $query['gl'] = $country;
        }

        if(!empty($source)){
            $query['ds'] = $source;
        }

        $url .= http_build_query($query);
        if(!empty($proxy)) $proxy = "tcp://$proxy";
        $aContext = array(
            'http' => array(
                'proxy'           => "$proxy",
                'request_fulluri' => true,
            ),
        );

        $cxContext = stream_context_create($aContext);
		
	if($content = trim(file_get_contents($url, false, $cxContext)));
        {
            $json = json_decode($content,true);
	    $out = $json[1]??'';
        }

        return $out;
	}
}
