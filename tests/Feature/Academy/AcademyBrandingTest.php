<?php

namespace Tests\Feature\Academy;

use App\Repositories\AcademyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\Traits\MakeAcademyTrait;
use Tests\Traits\MakeInstructorTrait;
use Tests\Traits\ReSeedDatabase;
use Tests\ApiTestTrait;


class AcademyBrandingTest extends TestCase
{
    #use ReSeedDatabase;
    use DatabaseTransactions;
    use MakeAcademyTrait, MakeInstructorTrait, ApiTestTrait, WithoutMiddleware;


    /**
     * @test
     */
    public function it_rejects_non_owners_from_changing_branding()
    {
        $instructor = $this->makeInstructor();
        $academy    = $this->makeAcademy();

        $instructor->academies()->attach($academy->AcademyID, ['IsEnabled'=>1]);

        $user = \App\AccountUser::find($instructor->InstructorID);
        $user->InstructorID = $instructor->InstructorID;

        $this->response = $this->actingAs($user)
            ->json('PATCH', '/api201902/academies/'.$academy->AcademyID.'/branding');

        //the loading is off of a relationship that defines IsMaster = 1 in the join
        //so a non-master will always see no academy loaded
        $this->assertEquals(404, $this->response->getStatusCode());
    }

    /**
     * @test
     */
    public function it_allows_owners_to_update_branding()
    {
        $instructor = $this->makeInstructor();
        $academy    = $this->makeAcademy();

        $instructor->academies()->attach($academy->AcademyID, ['IsEnabled'=>1, 'IsMaster'=>1]);

        $user = \App\AccountUser::find($instructor->InstructorID);
        $user->InstructorID = $instructor->InstructorID;

        $this->response = $this->actingAs($user)
            ->json('PATCH', '/api201902/academies/'.$academy->AcademyID.'/branding', [
                'banner_text'=>'updated with unit tests'
            ]);

        //the loading is off of a relationship that defines IsMaster = 1 in the join
        //so a non-master will always see no academy loaded
        $this->assertEquals(200, $this->response->getStatusCode());

        $academyRepo = \App::make(AcademyRepository::class);

        $updatedAcademy = $academyRepo->find( $academy->AcademyID );
        
        $this->assertEquals('updated with unit tests', $updatedAcademy->BannerText);
    }
}
