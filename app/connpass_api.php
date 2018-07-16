<?php
    require '../vendor/autoload.php';

    /**
     * function summary
     * access to connpass api.
     * 
     * @param String $nickname search parameter for connpass API.
     * @return String $result Acquired json file from connpass API.
     **/
    function api_get_contents($nickname){

        $baseUrl = 'https://connpass.com';
        $url = $baseUrl.'/api/v1/event/?nickname='.$nickname;

        $curl = curl_init($url);

        //curl_setopt($curl, );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $result = json_decode($response, true);

        curl_close($curl);

        return $result;
    }
    
