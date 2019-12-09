<?php

namespace Tests;

trait ApiTestTrait
{
    public function assertApiResponse(Array $actualData)
    {
        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        $responseData = $response['data'];

        $this->assertNotEmpty($responseData['id']);
//        $this->assertModelData($actualData, $responseData);
    }

    public function assertApiSuccess()
    {
        $this->assertTrue($this->response->isOk());
        $json = json_decode($this->response->getContent(), true);
        $this->assertFalse(key_exists('errors', $json));
    }

    public function assertModelData(Array $actualData, Array $expectedData)
    {
        foreach ($actualData as $key => $value) {
            if (substr($key, -2) === 'ID') { continue; }
            $this->assertEquals($expectedData[$key], $actualData[$key]);
        }
    }
}
