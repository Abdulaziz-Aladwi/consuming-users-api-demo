<?php

namespace Tests\Feature;

use App\Services\UsersApiClientService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ConsumeUsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_consuming_users_with_valid_data()
    {
       $this->artisan('consume:users')->assertExitCode(0);
    }
}
