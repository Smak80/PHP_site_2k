<?php

class test
{
    private $x;

    function somefunc(string $param): int{
        print($param);
        return 0;
    }
}

$test = new test();
$test->somefunc("test");