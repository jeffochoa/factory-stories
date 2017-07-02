<?php

namespace FactoryStories;

use FactoryStories\Contracts\FactoryStoryContract;

/**
* Factory Story class
*/
class FactoryStory
{

    /**
     * StoryClass class name
     *
     * @var ::class
     */
    protected $storyClass;

    protected $times = 1;

    /**
     * Build new FactoryStory object
     *
     * @param FactoryStoryContract $storyClass
     */
    public function __construct(FactoryStoryContract $storyClass)
    {
        $this->storyClass = $storyClass;
    }

    /**
     * How many instance of the $storyClass should
     * be created
     *
     * @param  integer      $amount Number of times to repeat
     *
     * @return FactoryStory $this Updated $times
     */
    public function times($amount)
    {
        $this->times = $amount;

        return $this;
    }

    /**
     * Run handle method on $this->storyClass and
     * return the result
     *
     * @param  array  $params Array of custom params
     *
     * @return Mixed
     */
    public function create($params = [])
    {
        if (is_int($this->times) && $this->times > 1) {
            return collect(range(1, $this->times))
                ->transform(function ($index) use ($params) {
                    return (new $this->storyClass)->handle($params);
                });
        }

        return (new $this->storyClass)->handle($params);
    }
}
