<?php 

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\Traits\MakeAnalysisTrait;
use Tests\Traits\ReSeedDatabase;
use Tests\ApiTestTrait;

class LoginTest extends TestCase
{
    #use DatabaseTransactions;
    use ReSeedDatabase;
    use MakeAnalysisTrait, ApiTestTrait, WithoutMiddleware;

    /**
     * @test
     * @dataProvider goodLogins
     */
    public function test_login_produces_jwt($email, $password, $isInstructor)
    {
        $this->response = $this
            ->post('/api201902/login',[
                'email'=>$email,
                'password'=>$password,
            ]);

        $jsonData = $this->response->getData();

        $this->response->assertJsonStructure(
            ['access_token', 'token_type', 'expires_in']
        );

        $jwtParts = explode('.', $jsonData->access_token);
        $userStruct = json_decode(base64_decode($jwtParts[1]), true);
        $this->assertEquals($email, (string)$userStruct['sub']);
        $this->assertEquals($isInstructor, (string)$userStruct['inst']);
    }

    public function goodLogins() {
        return [
            [
                'carl@customer.test',
                'password',
                '0',
            ],
            [
                'pauline@example.com',
                'password',
                '1',
            ]
        ];
    }

    /**
     * @test
     * @dataProvider badLogins
     */
    public function test_login_rejects_bad_passwords($email, $password)
    {
        $this->response = $this
            ->post('/api201902/login',[
                'email'=>$email,
                'password'=>$password,
            ]);

        $this->response->assertStatus(401);
    }

    public function badLogins() {
        return [
            [
                'carl@customer.test',
                'password2',
            ],
            [
                'pauline@example.com',
                'hacker',
            ]
        ];
    }
}
