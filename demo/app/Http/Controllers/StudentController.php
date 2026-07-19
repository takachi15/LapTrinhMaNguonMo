<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()

    {
        // Mảng tĩnh (ôn tập PHP mảng)
        $students = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' =>

            'an@huit.edu.vn'],

            ['name' => 'Trần Bình', 'age' => 18, 'email' =>

            'binh@huit.edu.vn'],

            ['name' => 'Lê Chi', 'age' => 17, 'email' =>

            'chi@huit.edu.vn'],

            ['name' => 'Phạm Dũng', 'age' => 20, 'email' =>

            'dung@huit.edu.vn'],

            ['name' => 'Đỗ Em', 'age' => 21, 'email' =>

            'em@huit.edu.vn'],
        ];
        return view('students.index', compact('students'));
    }
    public function indexDb()
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        return view('students.index_db', compact('students'));
    }
    public function indexDb1()
    {
        $gender = request('gender'); // 'male' | 'female' | null
        $query = \App\Models\Student::query()->orderBy('id', 'desc');
        if ($gender) {
            $query->where('gender', $gender);
        }
        $students = $query->paginate(5)->appends(compact('gender'));

        return view('students.index_db', compact('students', 'gender'));
    }
}
