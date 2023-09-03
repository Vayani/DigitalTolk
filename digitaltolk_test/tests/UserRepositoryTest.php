<?php

use Tests\TestCase;
use Carbon\Carbon;
use tests\app\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{

    public function test_when_create_update_new_user()
    {
        $request = [
            'role' => 'translator',
            'name' => 'John Doe',
            // Add other required fields for a new user
        ];

        $user = $this->repository->createOrUpdate(null, $request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('translator', $user->user_type);
        $this->assertEquals('John Doe', $user->name);
        // Add more assertions for other fields
    }

    public function test_when_create_update_existing_user()
    {
        // Create a user for testing
        $user = User::create([
            'user_type' => 'customer',
            'name' => 'Jane Smith',
            // Add other required fields for the user
        ]);

        $request = [
            'role' => 'customer',
            'name' => 'Updated Name',
            // Add other fields you want to update
        ];

        $updatedUser = $this->repository->createOrUpdate($user->id, $request);

        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertEquals('customer', $updatedUser->user_type);
        $this->assertEquals('Updated Name', $updatedUser->name);
        // Add more assertions for other fields
    }
    
}