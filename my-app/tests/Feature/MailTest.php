<?php

namespace Tests\Feature;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testSendMail(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        
        Mail::to($user->email)->queue(new WelcomeMail($user));

        Mail::assertQueued(WelcomeMail::class);
    }
}
