<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUsersAreCreatedOK()
    {
        // Prepare
        Storage::fake('general');

        $faker = Factory::create();

        $user = [
            'name'      => $name = $faker->name,
            'email'     => $email = $faker->unique()->safeEmail,
            'password'  => $password = bcrypt('secret'),
            'file'      => $file = UploadedFile::fake()->image('logo.png')
        ];

        // Login a authorized user and Execute
        $authorizeUser = factory(User::class)->create();
        $response = $this->actingAs($authorizeUser, 'api')->json('POST', 'api/v1/user', $user);

        // Assert
        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);

        $this->assertDatabaseHas('users', [
            'name'      => $name,
            'email'     => $email,
            'password'  => $password,
            'file'      => $file
        ]);
    }
}
