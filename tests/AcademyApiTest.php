<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcademyApiTest extends TestCase
{
    use MakeAcademyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAcademy()
    {
        $academy = $this->fakeAcademyData();
        $this->json('POST', '/api/v1/academies', $academy);

        $this->assertApiResponse($academy);
    }

    /**
     * @test
     */
    public function testReadAcademy()
    {
        $academy = $this->makeAcademy();
        $this->json('GET', '/api/v1/academies/'.$academy->AcademyID);

        $this->assertApiResponse($academy->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAcademy()
    {
        $academy = $this->makeAcademy();
        $editedAcademy = $this->fakeAcademyData();

        $this->json('PUT', '/api/v1/academies/'.$academy->AcademyID, $editedAcademy);

        $this->assertApiResponse($editedAcademy);
    }

    /**
     * @test
     */
    public function testDeleteAcademy()
    {
        $academy = $this->makeAcademy();
        $this->json('DELETE', '/api/v1/academies/'.$academy->AcademyID);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/academies/'.$academy->AcademyID);

        $this->assertResponseStatus(404);
    }
}
