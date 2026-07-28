<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User; // Import Model User

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Student::with('profile')->first(); 
        
        return view('profile.show', compact('user'));
    }
}