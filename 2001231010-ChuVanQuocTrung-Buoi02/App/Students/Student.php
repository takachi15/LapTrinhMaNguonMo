<?php
namespace App\Students;

class Student extends Person
{
    public $maSinhVien;

    public function __construct($hoTen, $tuoi, $maSinhVien)
    {
        parent::__construct($hoTen, $tuoi);
        $this->maSinhVien = $maSinhVien;
    }
}