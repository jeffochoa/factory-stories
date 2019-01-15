<?php

if (! function_exists('story'))
{
    function story($class)
    {
        return (new $class);
    }
}