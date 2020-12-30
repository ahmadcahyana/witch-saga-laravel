<?php


namespace App\Helpers;


class Person
{
    public $age_of_death;
    public $year_of_death;

    function __construct($age_of_death, $year_of_death) {
        $this->setAgeOfDeath($age_of_death);
        $this->setYearOfDeath($year_of_death);
    }

    public function getResult(){
        $witch = new Witch();
        $born = $this->getYearOfDeath() - $this->getAgeOfDeath();
        $witch->setYear($born);
        $result = array(
            'born' => $born,
            'year_of_death' => $this->getYearOfDeath(),
            'age_of_death' => $this->getAgeOfDeath(),
            'killed' => $witch->kill()
        );
        return $result;
    }

    public function getAgeOfDeath()
    {
        return $this->age_of_death;
    }

    public function setAgeOfDeath($age_of_death): void
    {
        $this->age_of_death = $age_of_death;
    }

    public function getYearOfDeath()
    {
        return $this->year_of_death;
    }

    public function setYearOfDeath($year_of_death): void
    {
        $this->year_of_death = $year_of_death;
    }
}
