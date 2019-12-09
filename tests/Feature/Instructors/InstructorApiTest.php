<?php

namespace Tests\Feature\Instructors;

use App\Models\Instructor;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use Tests\Traits\MakeInstructorTrait;
use Tests\Traits\MakeAcademyTrait;
use Tests\Traits\MakeAccountTrait;
use Tests\ApiTestTrait;

class InstructorApiTest extends TestCase
{
    use MakeInstructorTrait, MakeAccountTrait, MakeAcademyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInstructor()
    {
        $instructor = $this->fakeInstructorData();
        $this->response = $this->json('POST', '/api201902/instructors', $instructor);
        $this->response->assertStatus(404);
    }

    /**
     * @test
     */
    public function testReadInstructor()
    {
        $instructor = $this->makeInstructor();
        $this->response = $this->json('GET', '/api201902/instructors/'.$instructor->InstructorID);

        $this->assertApiResponse($instructor->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInstructor()
    {
        //updating as no one is not allowed
        $instructor = $this->makeInstructor();
        $editedInstructor = $this->fakeInstructorData();

        $this->response = $this->json('POST', '/api201902/instructors/'.$instructor->InstructorID, $editedInstructor);

        $this->response->assertStatus(403);
    }

    /**
     * @test
     */
    public function testDeleteInstructor()
    {
        //delete route isn't even defined
        $instructor = $this->makeInstructor();
        $this->response = $this->json('DELETE', '/api201902/instructors/'.$instructor->InstructorID);
        $this->response->assertStatus(405);

        $this->response = $this->json('GET', '/api201902/instructors/'.$instructor->InstructorID);
        $this->response->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_read_students_only_active_academies()
    {
        //add student to disabled academy,
        //attach academy to instructor as not enabled
        //ensure only 12 students come back.
        //new student would be 13
        $instructor = Instructor::find(1);
        $academy    = $this->makeAcademy();
        $student    = $this->makeAccount();
        $academy->students()->attach($student);

        $student    = $this->makeAccount();
        $academy->students()->attach($student);

        $instructor->academies()->attach($academy->AcademyID, ['IsEnabled'=>0]);

        $user = \App\AccountUser::find(1);
        $user->InstructorID = $instructor->InstructorID;

        $this->response = $this->actingAs($user)
            ->json('GET', '/api201902/instructors/'.$instructor->InstructorID.'/students/?withAcademy=true');

        $this->assertEquals(12, $this->response->getData()->meta->total);
    }


    /**
     * @test
     */
    public function test_read_only_personal_students()
    {
        //add student to disabled academy,
        //attach academy to instructor as not enabled
        //ensure only 12 students come back.
        //new student would be 13
        $instructor = Instructor::find(1);
        $academy    = $this->makeAcademy();
        $student    = $this->makeAccount();
        $academy->students()->attach($student);

        $student    = $this->makeAccount();
        $academy->students()->attach($student);

        $instructor->academies()->attach($academy->AcademyID, ['IsEnabled'=>1]);

        $user = \App\AccountUser::find(1);
        $user->InstructorID = $instructor->InstructorID;

        $this->response = $this->actingAs($user)
            ->json('GET', '/api201902/instructors/'.$instructor->InstructorID.'/students/');

        $this->assertEquals(12, $this->response->getData()->meta->total);
    }
}
