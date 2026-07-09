<?php
namespace App\Students;

class Person
{
    public $hoTen;
    public $tuoi;

    public function __construct($hoTen, $tuoi)
    {
        $this->hoTen = $hoTen;
        $this->tuoi = $tuoi;
    }
}