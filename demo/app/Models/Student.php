<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Dòng này bắt buộc
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; // Dòng này bắt buộc nằm trong class

    protected $fillable = ['name', 'email', 'age', 'gender'];
}
