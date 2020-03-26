<?php

class WPPluginInpsydeTest extends \PHPUnit\Framework\TestCase
{
    public function testConsumeApi()
    {
        $apiUrl = "https://jsonplaceholder.typicode.com/users"; // call api
        
        // setup api for json decode
        $client = curl_init($apiUrl);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $httpCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
        
        // return variable for json
        $result = json_decode($response, true);

        // assertions
        $this->assertEquals(200, $httpCode);
        $this->assertTrue(count($result) > 0, "Something went wrong with the API call.");
    }
}
