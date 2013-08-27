<?php

class OX_TestCase extends PHPUnit_Framework_TestCase
{
    protected function getPrivateProperty($board, $name)
    {
        $reflection = new ReflectionClass('Board');
        $property = $reflection->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($board);
    }
}
