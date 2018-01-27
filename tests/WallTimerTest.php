<?php

use WallTimer\WallTimer;
use WallTimer\Exception;

class WallTimerTest extends PHPUnit_Framework_TestCase
{

    public function testMeasuringTime()
    {
        $performance = new WallTimer();

        $performance->setAllowEchoOutput(false);
        $performance->start();

        sleep(1);

        $performance->end();

        $this->assertGreaterThan(0, $performance->getTotalTime(), "Test is so fast ! Is not possible");
    }

    public function testUnauthorizedTimeOutput()
    {
        $fail = false;

        try {
           $wallTimer = new WallTimer();
           $wallTimer->setTimeOutput("x");
        } catch (Exception\UnauthorizedTimeOutput $exception) {
            $fail = true;
        }

        $this->assertTrue($fail, "Fail in PerformanceHelper constructor");
    }

    public function testUnauthorizedLanguage()
    {
        $fail = false;
        $performance = new WallTimer();


        try {
            $performance->setOutputLanguage("ee");
        } catch (Exception\UnauthorizedLanguageOutput $e) {
            $fail = true;
        }

        $this->assertTrue($fail);
    }

}