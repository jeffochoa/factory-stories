<?php

namespace FactoryStories\Contracts;

/**
 * FactoryStory contract to be implemented by
 * every new factory story class
 */
interface FactoryStoryContract
{
    public function handle($params = []);
}
