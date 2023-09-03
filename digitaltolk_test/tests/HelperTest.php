<?php

use Tests\TestCase;
use Carbon\Carbon;
use tests\app\Helpers\TeHelper;

class HelperTest extends TestCase
{
    public function test_when_due_is_less_than_equal_90()
    {
        $dueTime = Carbon::now()->addHours(90); // Example due time
        $createdAt = Carbon::now(); // Example created_at time
        
        // Call the function you want to test
        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert that the result matches the expected result
        $this->assertEquals($dueTime->format('Y-m-d H:i:s'), $result);
    }

    public function test_when_due_is_less_than_equal_72()
    {
        $dueTime = Carbon::now()->addHours(72); // Example due time
        $createdAt = Carbon::now(); // Example created_at time
        
        // Call the function you want to test
        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert that the result matches the expected result
        $this->assertEquals($createdAt->addHours(16)->format('Y-m-d H:i:s'), $result);
    }

    public function test_when_due_is_less_than_equal_24()
    {
        $dueTime = Carbon::now()->addHours(24); // Example due time
        $createdAt = Carbon::now(); // Example created_at time
        
        // Call the function you want to test
        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert that the result matches the expected result
        $this->assertEquals($createdAt->addMinutes(90)->format('Y-m-d H:i:s'), $result);
    }

    public function test_when_due_is_above_90()
    {
        $dueTime = Carbon::now()->addHours(92); // Example due time
        $createdAt = Carbon::now(); // Example created_at time
        
        // Call the function you want to test
        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        // Assert that the result matches the expected result
        $this->assertEquals($dueTime->subHours(48)->format('Y-m-d H:i:s'), $result);
    }
}