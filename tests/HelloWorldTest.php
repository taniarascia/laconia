<?php

use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    public function testHello() 
    {
        $this->assertEquals('Hello', 'Hell' . 'o');
    }
}