<?php


namespace App\Helpers;


class Witch
{
    public $year;

    function kill(){
        $addition = 1;
        for ($i = 0; $i < $this->getYear(); $i++) {
            $addition = $addition+$i;
        }
        return $addition;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): void
    {
        $this->year = $year;
    }
}
