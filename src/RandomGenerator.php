<?php

namespace Qmegas;

class RandomGenerator 
{
    protected $min;
    protected $distribution;
    protected $realMax;

    public function __construct(int $min, int $max, callable $distributionFunc) 
    {
        $this->min = $min;

        $variants = $max - $min + 1;
        if ($variants < 1) {
            throw new RandomGeneratorException('Wrong min-max values');
        }

        $this->distribution = array_fill(0, $variants, 0);
        $sum = 0;
        for ($i = 0; $i < $variants; ++$i) {
            $sum += max(0, (int)$distributionFunc(($i + 1) / $variants));
            $this->distribution[$i] = $sum;
        }

        $this->realMax = max($this->distribution);
    }

    public function getNumber(): int 
    {
        $number = mt_rand(0, $this->realMax);
        return $this->min + $this->getBestIndex($number);
    }

    protected function getBestIndex(int $number): int 
    {
        //Sort of iterrative binary search
        $minLimit = 0;
        $maxLimit = $maxCount = count($this->distribution) - 1;

        while (true) {
            if ($minLimit === $maxLimit) {
                return $minLimit;
            }
            
            $midVal = intval(($maxLimit + $minLimit) / 2);
            if ($this->distribution[$midVal] === $number) {
                return $midVal;
            } elseif ($this->distribution[$midVal] > $number) {
                if ($midVal === 0 || $this->distribution[$midVal - 1] < $number) {
                    return $midVal;
                }
                $maxLimit = $midVal;
            } else {
                $minLimit = $midVal + 1;
            }
        }
    }
}
