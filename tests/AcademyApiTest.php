<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAcademyTrait;
use Tests\Traits\MakeInstructorTrait;
use Tests\ApiTestTrait;

class AcademyApiTest extends TestCase
{
    use MakeAcademyTrait, MakeInstructorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAcademy()
    {
        $academy = $this->fakeAcademyData();
        $this->response = $this->json('POST', '/api201902/academies', $academy);

        $this->response->assertStatus(403);
        //$this->assertApiResponse($academy);
    }

    /**
     * @test
     */
    public function testReadAcademy()
    {
        $academy = $this->makeAcademy();
        $this->response = $this->json('GET', '/api201902/academies/'.$academy->AcademyID);

        $this->assertApiResponse($academy->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAcademy()
    {
        $academy = $this->makeAcademy();
        $editedAcademy = $this->fakeAcademyData();

        $instructor = $this->makeInstructor();
        $instructor->academies()->attach($academy->AcademyID, ['IsEnabled'=>1]);

        $user = \App\AccountUser::find(1);
        $user->InstructorID = $instructor->InstructorID;
        $user->IsInstructor = true;
        $user->AcademyID    = $academy->AcademyID;

        $this->response = $this->actingAs($user)
            ->json('PATCH', '/api201902/academies/'.$academy->AcademyID, $editedAcademy);

        $this->assertApiResponse($editedAcademy);
    }

    /**
     * @test
     */
    public function testDeleteAcademy()
    {
        $academy = $this->makeAcademy();
        $this->response = $this->json('DELETE', '/api201902/academies/'.$academy->AcademyID);

        $this->response->assertStatus(403);
        //$this->assertApiSuccess();
        $this->response = $this->json('GET', '/api201902/academies/'.$academy->AcademyID);

        $this->response->assertStatus(200);
    }
}
