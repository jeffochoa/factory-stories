<?php

namespace Tests\FactoryStories;

use FactoryStories\FactoryStory;
use Tests\Models\User;

class UserFactoryStory extends FactoryStory
{
    public function build($params = [])
    {
        return factory(User::class)->make();
    }
}
