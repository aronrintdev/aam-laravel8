<?php

use App\Models\Academy;
use App\Repositories\AcademyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcademyRepositoryTest extends TestCase
{
    use MakeAcademyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AcademyRepository
     */
    protected $academyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->academyRepo = App::make(AcademyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAcademy()
    {
        $academy = $this->fakeAcademyData();
        $createdAcademy = $this->academyRepo->create($academy);
        $createdAcademy = $createdAcademy->toArray();
        $this->assertArrayHasKey('id', $createdAcademy);
        $this->assertNotNull($createdAcademy['id'], 'Created Academy must have id specified');
        $this->assertNotNull(Academy::find($createdAcademy['id']), 'Academy with given id must be in DB');
        $this->assertModelData($academy, $createdAcademy);
    }

    /**
     * @test read
     */
    public function testReadAcademy()
    {
        $academy = $this->makeAcademy();
        $dbAcademy = $this->academyRepo->find($academy->AcademyID);
        $dbAcademy = $dbAcademy->toArray();
        $this->assertModelData($academy->toArray(), $dbAcademy);
    }

    /**
     * @test update
     */
    public function testUpdateAcademy()
    {
        $academy = $this->makeAcademy();
        $fakeAcademy = $this->fakeAcademyData();
        $updatedAcademy = $this->academyRepo->update($fakeAcademy, $academy->AcademyID);
        $this->assertModelData($fakeAcademy, $updatedAcademy->toArray());
        $dbAcademy = $this->academyRepo->find($academy->AcademyID);
        $this->assertModelData($fakeAcademy, $dbAcademy->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAcademy()
    {
        $academy = $this->makeAcademy();
        $resp = $this->academyRepo->delete($academy->AcademyID);
        $this->assertTrue($resp);
        $this->assertNull(Academy::find($academy->AcademyID), 'Academy should not exist in DB');
    }
}
