<?php

namespace HiFolks\RandoPhp\Tests;

use HiFolks\RandoPhp\Randomize;
use PHPUnit\Framework\TestCase;

class RandomIntegerTest extends TestCase
{
    /** @test */
    public function random_integer()
    {
        $number = Randomize::integer()->max(5)->generate();
        $this->assertGreaterThanOrEqual(0, $number, "Check min number");
        $this->assertLessThanOrEqual(5, $number, "Check max number");
        $this->assertIsInt($number, "Check is integer");
    }
    /** @test */
    public function random_integer_min_max()
    {
        $min=90;
        $max=95;
        $number = Randomize::integer()->min($min)->max($max)->generate();
        $this->assertGreaterThanOrEqual($min, $number, "Check min number");
        $this->assertLessThanOrEqual($max, $number, "Check max number");
        $this->assertIsInt($number, "Check is integer");

        $number = Randomize::integer()->range($min, $max)->generate();
        $this->assertGreaterThanOrEqual($min, $number, "Check min number generated via range");
        $this->assertLessThanOrEqual($max, $number, "Check max number generated via range");
        $this->assertIsInt($number, "Check is integer generated via range");


    }

    /** @test */
    public function random_integer_min_max_wrong()
    {
        $min=50;
        $max=30;
        $catch=false;
        try {
            $number = Randomize::integer()->min($min)->max($max)->generate();
        } catch (\Exception $e) {
            $catch = true;
            $this->assertGreaterThan(0, $e->getCode(), "Code exception test");
        } catch (\Error $e) {
            $catch = true;
            $this->assertStringContainsString("Minimum", $e->getMessage(), "Message Error test");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }


}
