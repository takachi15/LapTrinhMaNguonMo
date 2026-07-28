<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Student;

class ReportController extends Controller
{
    public function index()
    {
        $expensiveProducts = Product::where('price', '>', 100000)->get();
        $categoriesWithCount = Category::withCount('products')->get();
        $studentsWithCount = Student::withCount('courses')->get();

        return view('reports.index', compact(
            'expensiveProducts',
            'categoriesWithCount',
            'studentsWithCount'
        ));
    }
}