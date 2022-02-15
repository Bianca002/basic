<?php

declare(strict_types=1);

class Car
{
    public string $brand;

    protected string $model;

    public string $releaseDate;

    private string $vin = '12345';

    public function __construct(
        string $brand,
        string $model,
        DateTime $releaseDate
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->releaseDate = $releaseDate->format('d/m/Y');
    }

    public function model(): string
    {
        return $this->model;
    }

    public function vin(): string
    {
        return $this->vin;
    }

    public function dateTime(): DateTime
    {
        return DateTime::createFromFormat('d/m/Y', $this->releaseDate);
    }
}

class Toyota extends Car
{
    public function __construct(string $model, DateTime $releaseDate)
    {
        parent::__construct('Toyota', $model, $releaseDate);
    }

    public function model(): string
    {
        return 'this is a '.$this->model.' Corolla';
    }

    public function toyotaVin(): string
    {
        return $this->vin;
    }
}

class CarChecker
{
    public function __construct(private Car $car)
    {
    }

    public function check(): bool
    {
        return $this->car->dateTime() < DateTime::createFromFormat('Y', '2010');
    }
}

$corolla = new Car(
    'Toyota',
    'Corolla',
    DateTime::createFromFormat('Y/m/d', '2007/03/24')
);

$prius = new Toyota(
    'Prius',
    DateTime::createFromFormat('Y/m/d', '2011/03/24')
);

//var_dump($corolla);
//var_dump($prius);

//var_dump($corolla instanceof Car); // true
//var_dump($prius instanceof Car); // true
//var_dump($corolla instanceof Toyota); // false
//var_dump($prius instanceof Toyota); // true

//var_dump($corolla->model());
//var_dump($prius->model());

//var_dump($corolla->vin());
//var_dump($prius->toyotaVin());

$corollaChecker = new CarChecker($corolla);
$priusChecker = new CarChecker($prius);

var_dump($corollaChecker->check());
var_dump($priusChecker->check());

