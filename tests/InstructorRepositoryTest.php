<?php

use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use Tests\Traits\MakeInstructorTrait;
use Tests\ApiTestTrait;

class InstructorRepositoryTest extends TestCase
{
    use MakeInstructorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InstructorRepository
     */
    protected $instructorRepo;

    public function setUp() :void
    {
        parent::setUp();
        $this->instructorRepo = \App::make(InstructorRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInstructor()
    {
        $instructor = $this->fakeInstructorData();
        $createdInstructor = $this->instructorRepo->create($instructor);
        $createdInstructor = $createdInstructor->toArray();
        $this->assertArrayHasKey('id', $createdInstructor);
        $this->assertNotNull($createdInstructor['id'], 'Created Instructor must have id specified');
        $this->assertNotNull(Instructor::find($createdInstructor['id']), 'Instructor with given id must be in DB');
        $this->assertModelData($instructor, $createdInstructor);
    }

    /**
     * @test read
     */
    public function testReadInstructor()
    {
        $instructor = $this->makeInstructor();
        $dbInstructor = $this->instructorRepo->find($instructor->InstructorID);
        $dbInstructor = $dbInstructor->toArray();
        $this->assertModelData($instructor->toArray(), $dbInstructor);
    }

    /**
     * @test update
     */
    public function testUpdateInstructor()
    {
        $instructor = $this->makeInstructor();
        $fakeInstructor = $this->fakeInstructorData();
        $updatedInstructor = $this->instructorRepo->update($fakeInstructor, $instructor->InstructorID);
        $this->assertModelData($fakeInstructor, $updatedInstructor->toArray());
        $dbInstructor = $this->instructorRepo->find($instructor->InstructorID);
        $this->assertModelData($fakeInstructor, $dbInstructor->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInstructor()
    {
        $instructor = $this->makeInstructor();
        $resp = $this->instructorRepo->delete($instructor->InstructorID);
        $this->assertTrue($resp);
        $this->assertNull(Instructor::find($instructor->InstructorID), 'Instructor should not exist in DB');
    }
}
