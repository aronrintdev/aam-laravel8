<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InstructorApiTest extends TestCase
{
    use MakeInstructorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInstructor()
    {
        $instructor = $this->fakeInstructorData();
        $this->json('POST', '/api/v1/instructors', $instructor);

        $this->assertApiResponse($instructor);
    }

    /**
     * @test
     */
    public function testReadInstructor()
    {
        $instructor = $this->makeInstructor();
        $this->json('GET', '/api/v1/instructors/'.$instructor->InstructorID);

        $this->assertApiResponse($instructor->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInstructor()
    {
        $instructor = $this->makeInstructor();
        $editedInstructor = $this->fakeInstructorData();

        $this->json('PUT', '/api/v1/instructors/'.$instructor->InstructorID, $editedInstructor);

        $this->assertApiResponse($editedInstructor);
    }

    /**
     * @test
     */
    public function testDeleteInstructor()
    {
        $instructor = $this->makeInstructor();
        $this->json('DELETE', '/api/v1/instructors/'.$instructor->InstructorID);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/instructors/'.$instructor->InstructorID);

        $this->assertResponseStatus(404);
    }
}
