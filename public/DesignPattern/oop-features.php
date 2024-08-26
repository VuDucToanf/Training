<?php

// system designers
interface Animal
{
    public function eat();
    public function getWeight();
}

abstract class Primate implements Animal
{
    private $name;
    private $weight;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    abstract function setWeight($weight);
    abstract function getWeight();

    public function eat()
    {
        echo "\nEat anything";
    }



}

function compareAnimal(Animal $p1, Animal $p2)
{
    if ($p1->getWeight() >= $p2->getWeight()) {
        echo "\n1 is bigger";
    } else {
        echo "\n2 is bigger";
    }
    echo $p1->work(); //???
}


// developers

class Human extends Primate
{
    // Public Private Protected Default
    private $height;

    public function setWeight($weight)
    {
        if ($weight > 100) {
            echo "\nWeight must be less than 100";
        } else {
            // parent::setWeight($weight);
            $this->weight = $weight;
        }
        
    }

    public function setHeight($height)
    {
        //check height

        $this->height = $height;
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function eat()
    {        
        parent::eat();
        echo "\nCook";
    }
    
    public function increaseHeight($value)
    {
        for ($i = 0; $i < $value; $i++) {
            $this->eat();
            $this->getWeight = $this->getWeight + 10;
        }
    }

    public function work()
    {
        echo "\nhuman work";
    }



}

// class Cat implements Animal
// {
//     public function eat()
//     {
//         echo "\nEat fish";
//     }
// }




function increaseHeight(Human $human, $value)
{
    for ($i = 0; $i < $value; $i++) {
        $human->eat();
        $human->setWeight($human->getWeight() + 10);
    }
}

// echo $developer->getHeight();
// $developer->eat();

// $cat = new Cat();
// $cat->setWeight(10);

$developer = new Human();
$developer->setName('Son');
$developer->setHeight(170);
$developer->setWeight(70);

$developer2 = new Human();
$developer2->setName('Toan');
$developer2->setHeight(160);
$developer2->setWeight(80);

compareAnimal($developer, $developer2);



