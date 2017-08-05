<?php

namespace FactoryStories;

use Illuminate\Support\Collection;
use FactoryStories\Contracts\FactoryStoryContract;

/**
* Factory Story class
*/
abstract class FactoryStory
{

    protected $times = 1;
    protected $with = null;

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
        $this->times = (int)$amount;

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
        if ($this->times <= 1) {
            return $this->forge($params);
        }
        
        return Collection::times($this->times, function () use ($params) {
            return $this->forge($params);
        });
    }
    
    /**
     * Add methods to be ran after initial build
     *
     * @param array $methods Array of method names
     *
     * @return FactoryStory $this Updated $with
     */

    public function with($methods = [])
    {
        if(!is_null($this->with)) {
            $this->with->merge(collect($methods));
        }
        else {
            $this->with = collect($methods);
        }

        return $this;
    }
    
    /**
     * Handles any creation steps that need to be done after building
     * a story but before returning
     *
     * @param  array  $params Array of custom params
     *
     * @return Mixed
     */

    public function forge($params = [])
    {
        if(is_null($this->with) || $this->with->count() === 0) {
            return $this->build($params);
        }

        $story = $this->build($params);

        $this->with->reduce(function($story, $methodName) {
            return $this->$methodName($story);
        }, $story);

        return $this->build($params);
    }
}
