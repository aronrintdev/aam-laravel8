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
    public function test_login_produces_jwt($email, $password)
    {
        $this->response = $this
            ->post('/api201902/login',[
                'username'=>$email,
                'password'=>$password,
            ]);

        $jsonData = $this->response->getData();

        $this->response->assertJsonStructure(
            ['access_token', 'token_type', 'expires_in']
        );
    }

    public function goodLogins() {
        return [
            [
                'carl@customer.test',
                'password',
            ],
            [
                'pauline@example.com',
                'password',
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
                'username'=>$email,
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
