<?php

class RandomGeneratorTest
{
    public function __construct()
    {
        $this->getBestIndexTest();
    }
    
    protected function getBestIndexTest()
    {
        $testClass = new class(0, 1, function() {
            return 1;
        }) extends \Qmegas\RandomGenerator {
            public function getBestIndexTest() {
                $this->distribution = [1, 3, 6, 9, 18, 37, 43, 44, 45, 89];
                assert($this->getBestIndex(2) === 1);
                assert($this->getBestIndex(3) === 1);
                assert($this->getBestIndex(4) === 2);
                assert($this->getBestIndex(43) === 6);
                assert($this->getBestIndex(44) === 7);
                assert($this->getBestIndex(45) === 8);
                assert($this->getBestIndex(88) === 9);
                assert($this->getBestIndex(89) === 9);
            }
        };
        
        $testClass->getBestIndexTest();
    }
}
