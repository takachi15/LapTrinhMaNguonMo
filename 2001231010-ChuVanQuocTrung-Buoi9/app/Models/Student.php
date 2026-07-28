<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; // Nên có dòng này để dùng được Student::factory()

    protected $fillable = ['name', 'email'];

    /**
     * Quan hệ 1-1 với Profile
     */
    public function profile()
    {
        
        return $this->hasOne(Profile::class);
    }

    /**
     * Quan hệ Nhiều - Nhiều với Course
     */
    public function courses()
    {
        // Giữ lại hàm này vì có khai báo rõ bảng trung gian 'student_course'
        return $this->belongsToMany(Course::class, 'course_student'); 
    }
}