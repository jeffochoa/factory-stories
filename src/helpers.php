<?php

/**
 * Shortcout to FactoryStories\FactoryStory
 *
 * @param  Story\Contracts\FactoryStoryContract  $storyClass Class
 * @param  integer $times Times to repeat this proccess
 *
 * @return Mixed
 */
function story($storyClass, $times = 1)
{
    return (new FactoryStories\FactoryStory(new $storyClass))->times($times);
}
