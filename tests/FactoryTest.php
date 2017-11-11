<?php

namespace Tests;

use Illuminate\Support\Collection;
use Tests\FactoryStories\UserFactoryStory;
use Tests\Models\User;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    /** @test */
    public function building_one_instance()
    {
        $instance = (new UserFactoryStory)->create();        

        $this->assertInstanceOf(User::class, $instance);
    }

    /** @test */
    public function building_a_collection_containing_multiple_instances()
    {
        $collection = (new UserFactoryStory)->times(5)->create();        

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(5, $collection);
        $this->assertContainsOnlyInstancesOf(User::class, $collection);
    }
}
