<?php

namespace WallTimer;

use WallTimer\Exception\UnauthorizedTimeOutput;
use WallTimer\Exception\UnauthorizedLanguageOutput;

/**
 * Class WallTimer
 * @package WallTimer
 */
class WallTimer
{

    /**
     * @var bool
     */
    private $allowEchoOutput = true;

    /**
     * @var int
     */
    private $outputPrecision = 2;

    /**
     * @var array
     */
    private $allowedOutputLanguages = ["cs", "en", "ru", "de"];

    /**
     * @var array
     */
    private $allowedTimeOutputs = ["h" => ["cs" => "hodin", "en" => "hours", "de" => "stunden lang", "ru" => "часов"], "m" => ["cs" => "minut", "en" => "minutes", "de" => "stunden lang", "ru" => "часов"], "s" => ["cs" => "sekund", "en" => "seconds", "de" => "sekunden", "ru" => "секунд"]];

    private $scriptRunningText = ["cs" => "Váš skript běžel", "en" => "Your script running", "ru" => "Ваш скрипт длился", "de" => "Dein Skript lief"];

    /**
     * @var string
     */
    private $timeOutput = "s";

    private $outputLanguage = "en";

    /**
     * @var string
     */
    private $startTime;

    /**
     * @var string
     */
    private $endTime;

    /**
     * @var float
     */
    private $totalTime;


    /**
     * Just set start time
     * @return void
     */
    public function start()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Just set end time
     */
    public function end()
    {
        $this->endTime = microtime(true);
        $this->countDiff();

        if ($this->allowEchoOutput) {
            $this->showOutput();
        }
    }

    /**
     * Echo results
     * @return void
     */
    private function showOutput()
    {
        echo $this->scriptRunningText[$this->outputLanguage] . " " . $this->totalTime . " " . $this->allowedTimeOutputs[$this->timeOutput][$this->outputLanguage];
    }

    /**
     * Count execution script time and convert to minutes, seconds or hours
     * @return void
     */
    private function countDiff()
    {
        switch ($this->timeOutput) {
            case "s":
                $this->totalTime = ($this->endTime - $this->startTime);
                break;
            case "m":
                $this->totalTime = ($this->endTime - $this->startTime) / 60;
                break;
            case "h":
                $this->totalTime = ($this->endTime - $this->startTime) / 60 / 60;
                break;
        }

        $this->totalTime = round($this->totalTime, $this->outputPrecision);
    }

    /**
     * Specify if on call end method execute echo output or not
     * @param bool $allowEchoOutput
     */
    public function setAllowEchoOutput($allowEchoOutput)
    {
        $this->allowEchoOutput = $allowEchoOutput;
    }


    /**
     * You can specify in what units the time will be displayed
     * allowed is: s, m, h (seconds, minutes, hours)
     * @param string $timeOutput
     * @throws UnauthorizedTimeOutput
     */
    public function setTimeOutput($timeOutput = "s")
    {

        if (!in_array($timeOutput, array_keys($this->allowedTimeOutputs))) {
            throw new UnauthorizedTimeOutput("Unauthorized time output " . $timeOutput);
        }
        $this->timeOutput = $timeOutput;
    }


    /**
     * Specifies the results of decimal digits to round to, default is 2
     * @param int $outputPrecision
     */
    public function setOutputPrecision($outputPrecision)
    {
        $this->outputPrecision = $outputPrecision;
    }

    /**
     * Allowed languages: cs, en, ru, de
     * @param string $outputLanguage
     * @throws UnauthorizedLanguageOutput
     */
    public function setOutputLanguage($outputLanguage)
    {
        if (!in_array($outputLanguage, $this->allowedOutputLanguages)) {
            throw new UnauthorizedLanguageOutput("Unauthorized language " . $outputLanguage);
        }

        $this->outputLanguage = $outputLanguage;

    }

    /**
     * @return float
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }


}