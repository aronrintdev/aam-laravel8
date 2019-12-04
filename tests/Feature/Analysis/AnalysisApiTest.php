<?php 

namespace Tests\Feature\Avatars;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\Traits\MakeAnalysisTrait;
use Tests\Traits\ReSeedDatabase;
use Tests\ApiTestTrait;

class AnalysisApiTest extends TestCase
{
    use ReSeedDatabase;
    use MakeAnalysisTrait, ApiTestTrait, WithoutMiddleware;

    /**
     * @test
     */
    public function test_read_all_instructor_analysis_swings()
    {
        $user = \App\AccountUser::find(1);
        $user->IsInstructor = 1;
        $this->response = $this->actingAs($user)
            ->json('GET', '/api201902/videolessons/?daysAgo=365');

        $jsonData = $this->response->getData()->data;

        $this->assertEquals(10, count($jsonData));
    }

    public function test_record_has_swing_id()
    {
        $user = \App\AccountUser::find(1);
        $user->IsInstructor = 1;
        $accountAvatar = $this->makeAnalysis();
        $this->response = $this->actingAs($user)
            ->json('GET', '/api201902/videolessons/?daysAgo=30');

        $jsonData = $this->response->getData()->data;

        $this->assertEquals(14, $jsonData[0]->attributes->source_video_id);
    }

    public function test_api_agent_can_query_any_instructor()
    {
        $user = \App\User::whereNotNull('api_token')->first();
        $this->response = $this->actingAs($user)
            ->json('GET', '/api201902/videolessons/?daysAgo=30&instructor_id=1');
        $jsonData = $this->response->getData()->data;

        $this->assertEquals(14, $jsonData[0]->attributes->source_video_id);
    }

    public function test_anon_access_fails()
    {
        $accountAvatar = $this->makeAnalysis();
        $this->response = $this
            ->json('GET', '/api201902/videolessons/?daysAgo=30&instructor_id=1');

        $this->assertTrue(
            $this->response->isForbidden()
        );
    }
}
