<?php

namespace FactoryStories;

use FactoryStories\Contracts\FactoryStoryContract;

/**
* Factory Story class
*/
abstract class FactoryStory
{

    protected $times = 1;

    /**
     * Here you can create your complex model factory
     * logic
     *
     * @param array $params Array of params
     *
     * @return Mixed
     */
    abstract public function build($params = []);

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
     * Run handle method and returns the result
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
                    return $this->build($params);
                });
        }

        return $this->build($params);
    }
}
