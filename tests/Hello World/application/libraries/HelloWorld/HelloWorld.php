<?php
class HelloWorld implements HelloWorldInterface
{
    public static function sayHello()
    {
        // Load language library
        load::library('FLLanguage');

        return FLLanguage::display('hw_hello_world');
    }
}