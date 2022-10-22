<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class UsersApiClientService 
{
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->getBaseURI()]);
    }

    /**
     * Undocumented function
     *
     * @param string $endPoint
     * 
     * @return Response
     */
    public function get($endPoint)
    {       
        return $this->client->get($endPoint);
    }

    /**
     * Get Base URI
     *
     * @return string
     */
    private function getBaseURI()
    {
        return 'https://60e1b5fc5a5596001730f1d6.mockapi.io/api/v1/users/';    
    }
}